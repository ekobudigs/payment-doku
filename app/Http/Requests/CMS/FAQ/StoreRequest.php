<?php

namespace App\Http\Requests\CMS\FAQ;

use App\Constants\GeneralStatus;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
    public function rules()
    {
        return [
            'question' => 'required',
            'answer' => 'required',
        ];
    }

    /**
     * Final result of the form request.
     *
     * @return array
     */
    public function faq()
    {
        return [
            'question' => $this->question,
            'answer' => $this->answer,
            'status' => GeneralStatus::ACTIVE,
        ];
    }
}
