<?php

namespace App\Http\Controllers\CMS\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;

class LogoutController extends Controller
{
    /**
     * Logout the current logged in administrator.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function process()
    {
        try {
            // Logout cms user
            auth('cms')->logout();

            return redirect()->route('cms.auth.login.index');
        }
        //
        catch (\Throwable $th) {
            return ResponseController::failed($th->getMessage());
        }
    }
}
