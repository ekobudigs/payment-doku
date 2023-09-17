<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class AppController extends Controller
{
    /**
     * Clear laravel application.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clear()
    {
        try {
            Artisan::call('app:clear');

            return ResponseController::success('Aplikasi telah berhasil dibersihkan.');
        } catch (\Throwable $th) {
            return ResponseController::failed($th->getMessage());
        }
    }

    /**
     * Optimize laravel application.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function optimize()
    {
        try {
            Artisan::call('app:optimize');

            return ResponseController::success('Aplikasi telah berhasil di-optimize.');
        } catch (\Throwable $th) {
            return ResponseController::failed($th->getMessage());
        }
    }
}
