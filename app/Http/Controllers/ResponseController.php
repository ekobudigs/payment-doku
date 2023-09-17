<?php

namespace App\Http\Controllers;

use App\Constants\SwalButton;
use App\Constants\SwalIcon;

class ResponseController extends Controller
{
    /**
     * Get flash session with success sweet alert data.
     *
     * @param  string  $text
     * @param  string  $redirectUrl
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function success($text, $redirectUrl = null)
    {
        $redirectUrl = $redirectUrl ?? back()->getTargetUrl();

        $icon = SwalIcon::SUCCESS;
        $title = SwalIcon::label($icon);
        $button = SwalButton::OK;

        return redirect()->to($redirectUrl)->with('swal', [
            'title' => $title,
            'text' => $text,
            'icon' => $icon,
            'button' => $button,
        ]);
    }

    /**
     * Get flash session with failed sweet alert data.
     *
     * @param  string  $text
     * @param  string  $redirectUrl
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function failed($text, $redirectUrl = null)
    {
        $redirectUrl = $redirectUrl ?? back()->getTargetUrl();

        $icon = SwalIcon::ERROR;
        $title = SwalIcon::label($icon);
        $button = SwalButton::OK;

        return redirect()->to($redirectUrl)->with('swal', [
            'title' => $title,
            'text' => $text,
            'icon' => $icon,
            'button' => $button,
        ]);
    }
}
