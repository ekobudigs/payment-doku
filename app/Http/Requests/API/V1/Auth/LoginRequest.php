<?php

namespace App\Http\Requests\API\V1\Auth;

use App\Http\Requests\BaseFormRequest;
use App\Services\UserService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

class LoginRequest extends FormRequest
{
    /**
     * Default service class.
     *
     * @var \App\Services\UserService
     */
    protected $userService;

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
        $this->userService = new UserService();
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
            'credential' => 'required|exists:users,'.$this->type,
            'password' => 'required',
        ];
    }

    /**
     * Validate user data after main rules.
     *
     * @param  Illuminate\Validation\Validator  $validator
     */
    public function withValidator(Validator $validator)
    {
        if ($validator->safe()->all()) {
            $validator->after(function ($validator) {
                // Get user data
                $user = $this->userService->findByCredentials($this->credentials())->first();

                // Cek user status
                if (! $user->status) {
                    $validator->errors()->add('account', __('response.auth.account.inactive'));
                }

                // Verify user password
                if (! Hash::check($this->password, $user->password)) {
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
     * Validated user data.
     *
     * @return mixed
     */
    public function validatedUser()
    {
        return $this->userService->findByCredentials($this->credentials())->first();
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
