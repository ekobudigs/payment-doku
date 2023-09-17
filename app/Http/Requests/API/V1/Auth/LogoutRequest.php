<?php

namespace App\Http\Requests\API\V1\Auth;

use App\Http\Requests\BaseFormRequest;
use App\Services\AdministratorService;
use Hash;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class LogoutRequest extends FormRequest
{
    /**
     * Default service class.
     *
     * @var \App\Services\AdministratorService
     */
    protected $administratorService;

    /**
     * Administrator login type.
     *
     * @var string
     * */
    private $type;

    /**
     * Initiate controller properties value.
     */
    public function __construct()
    {
        $this->administratorService = new AdministratorService();
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // Check login type
        $this->type = is_email($this->credential) ? 'email' : (is_phone(normalize_phone($this->credential)) ? 'phone' : 'username');

        return [
            'credential' => 'required|exists:administrators,'.$this->type,
            'password' => 'required',
        ];
    }

    /**
     * Validate administrator data after main rules.
     *
     * @param  Illuminate\Validation\Validator  $validator
     */
    public function withValidator(Validator $validator)
    {
        if ($validator->safe()->all()) {
            $validator->after(function ($validator) {
                // Get administrator data
                $administrator = $this->administratorService->findByCredentials($this->credentials())->first();

                // Cek administrator status
                if (! $administrator->status) {
                    $validator->errors()->add('account', __('response.auth.account.inactive'));
                }

                // Verify administrator password
                if (! Hash::check($this->password, $administrator->password)) {
                    $validator->errors()->add('credentials', __('auth.login.failed'));
                }
            });
        }
    }

    /**
     * Login credentials.
     *
     * @return array
     */
    public function credentials()
    {
        return [
            $this->type => is_phone($this->credential) ? normalize_phone($this->credential) : $this->credential,
            'password' => $this->password,
        ];
    }

    /**
     * Validated administrator data.
     *
     * @return mixed
     */
    public function administrator()
    {
        return $this->administratorService->findByCredentials($this->credentials())->first();
    }

    /**
     * Global form request attributes, with internationalization.
     *
     * @return array
     */
    public function attributes()
    {
        return BaseFormRequest::getI18nAttributes();
    }

    /**
     * Global form request messages, with internationalization.
     *
     * @return array
     */
    public function messages()
    {
        return BaseFormRequest::getI18nMessages();
    }
}
