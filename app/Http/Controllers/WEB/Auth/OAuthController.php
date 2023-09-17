<?php

namespace App\Http\Controllers\WEB\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    /**
     * Default service class.
     *
     * @var \App\Services\CustomerService
     */
    protected $customerService;

    /**
     * Initiate resource service class.
     */
    public function __construct()
    {
        $this->customerService = new CustomerService();
    }

    /**
     * Redirect with Socialite
     */
    public function redirect(Request $request)
    {
        return Socialite::driver($request->driver)->redirect();
    }

    /**
     * Retrieve request from socialite driver
     */
    public function callback(Request $request)
    {
        try {
            $user = Socialite::driver($request->driver)->user();
            $customer = $this->customerService->getByEmail($user->getEmail());

            // Register new customer if not already
            if (! $customer) {
                $username = $user->nickname ?? explode('@', $user->email)[0];
                $customer = $this->customerService->create([
                    'username' => $username,
                    'name' => $user->name,
                    'email' => $user->email,
                ]);

                $message = 'Selamat, akun Anda telah berhasil didaftarkan.';
            }

            $message ??= 'Selamat datang, Anda berhasil masuk.';

            auth('web')->login($customer);

            // Redirect to WEB home
            return ResponseController::success($message, route('web.home'));
        }
        //
        catch (\Throwable $th) {
            return ResponseController::failed($th->getMessage());
        }
    }
}
