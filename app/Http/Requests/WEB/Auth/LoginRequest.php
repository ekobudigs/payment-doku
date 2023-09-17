<?php

namespace App\Http\Requests\WEB\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Customer login type.
     *
     * @var string
     * */
    private $type;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Check login type
        $this->type = is_email($this->credential) ? 'email' : (is_phone(normalize_phone($this->credential)) ? 'phone' : 'username');

        return [
            'credential' => 'required|exists:customers,'.$this->type,
            'password' => 'required',
        ];
    }

    /**
     * Final result of the form request.
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
     * Remember me value.
     *
     * @return bool
     */
    public function remember()
    {
        return $this->remember == 'on';
    }
}
