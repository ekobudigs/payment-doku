<?php

namespace App\Http\Requests\CMS\Customer;

use App\Constants\GeneralStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('cms')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'username' => 'required|unique:customers,username,'.$request->customer,
            'name' => 'required',
            'email' => 'required|unique:customers,email,'.$request->customer,
            'phone' => 'nullable|unique:customers,phone,'.$request->customer,
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
            'status' => GeneralStatus::ACTIVE,
        ];

        // Include new password if its edited
        if ($this->password) {
            $credentials['password'] = Hash::make($this->password);
        }

        return $credentials;
    }
}
