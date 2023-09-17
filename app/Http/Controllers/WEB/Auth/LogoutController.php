<?php

namespace App\Http\Controllers\WEB\Auth;

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
            // Logout web user
            auth('web')->logout();

            return redirect()->route('web.home');
        }
        //
        catch (\Throwable $th) {
            return ResponseController::failed($th->getMessage());
        }
    }
}
