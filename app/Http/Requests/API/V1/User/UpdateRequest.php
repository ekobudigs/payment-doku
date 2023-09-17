<?php

namespace App\Http\Requests\API\V1\User;

use App\Constants\GeneralStatus;
use App\Constants\HttpStatus;
use App\Constants\UserRoleCode;
use App\Http\Requests\BaseFormRequest;
use App\Models\UserRole;
use App\Services\UserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Check user existance
        $user = (new UserService())->find($this->user);

        if (! $user) {
            throw new ModelNotFoundException(__('response.users.not_found'), HttpStatus::NOT_FOUND);
        }

        // Refactor phone number to i18n format
        $this->merge([
            'phone' => normalize_phone($this->phone),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|unique:users,username,'.$this->user,
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->user,
            'phone' => 'nullable|unique:users,phone,'.$this->user,
        ];
    }

    /**
     * Final result of the form request.
     *
     * @return array $credentials
     */
    public function credentials()
    {
        $credentials = [
            'username' => $this->username,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => normalize_phone($this->phone),
            'user_role_id' => UserRole::query()->where('code', UserRoleCode::CUSTOMER)->first()->id,
            'status' => GeneralStatus::ACTIVE,
        ];

        // Include new password if its edited
        if ($this->password) {
            $credentials['password'] = Hash::make($this->password);
        }

        return $credentials;
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
