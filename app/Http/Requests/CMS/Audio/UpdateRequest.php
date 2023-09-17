<?php

namespace App\Http\Requests\CMS\Audio;

use Illuminate\Foundation\Http\FormRequest;

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
    public function rules()
    {
        return [
            'name' => 'required',
            'audio' => 'file|mimetypes:audio/mpeg,audio/wav,audio/ogg,audio/mp3',
        ];
    }

    /**
     * Final result of the form request.
     *
     * @return array
     */
    public function audio()
    {
        return [
            'name' => $this->name,
        ];
    }
}
