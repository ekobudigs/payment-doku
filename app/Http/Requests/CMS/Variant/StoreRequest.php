<?php

namespace App\Http\Requests\CMS\Variant;

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
            'name' => 'required',
            'price' => 'required|numeric|integer',
            'discount_status' => 'required|boolean',
            'discount_type' => 'required_if:discount_status,1',
            'discount_amount' => 'required_if:discount_status,1',
            'allow_couple_photos' => 'required',
            'allow_galleries' => 'required',
            'allow_videos' => 'required',
            'allow_google_maps' => 'required',
            'allow_countdown' => 'required',
            'allow_backsound' => 'required',
            'allow_guest_book' => 'required',
            'allow_guest_target' => 'required',
            'allow_rsvp' => 'required',
            'allow_gift' => 'required',
            'max_galleries' => 'required_if:allow_galleries,1',
            'max_videos' => 'required_if:allow_videos,1',
        ];
    }

    /**
     * Final result of the form request.
     *
     * @return array
     */
    public function variant()
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'discount_status' => (bool) $this->discount_status,
            'discount_type' => $this->discount_type,
            'discount_amount' => $this->discount_amount,
            'allow_couple_photos' => (bool) $this->allow_couple_photos,
            'allow_galleries' => (bool) $this->allow_galleries,
            'allow_videos' => (bool) $this->allow_videos,
            'allow_google_maps' => (bool) $this->allow_google_maps,
            'allow_countdown' => (bool) $this->allow_countdown,
            'allow_backsound' => (bool) $this->allow_backsound,
            'allow_guest_book' => (bool) $this->allow_guest_book,
            'allow_guest_target' => (bool) $this->allow_guest_target,
            'allow_rsvp' => (bool) $this->allow_rsvp,
            'allow_gift' => (bool) $this->allow_gift,
            'max_galleries' => $this->max_galleries,
            'max_videos' => $this->max_videos,
            'status' => GeneralStatus::ACTIVE,
        ];
    }
}
