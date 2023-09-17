<?php

namespace App\Http\Controllers\WEB\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Http\Requests\WEB\Auth\LoginRequest;
use App\Services\CustomerService;
use Exception;

class LoginController extends Controller
{
    /**
     * Default service class.
     *
     * @var \App\Services\CustomerService
     */
    protected $customerService;

    /**
     * Controller module path.
     *
     * @var string
     */
    private $module;

    /**
     * Controller module title.
     *
     * @var string
     */
    private $title;

    /**
     * Initiate controller properties value.
     */
    public function __construct()
    {
        $this->customerService = new CustomerService();
        $this->module = 'web.auth';
        $this->title = 'Masuk';
    }

    /**
     * Display login page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $view = $this->module.'.login';
            $data['title'] = $this->title;

            return view($view, $data);
        }
        //
        catch (\Throwable $th) {
            return ResponseController::failed($th->getMessage());
        }
    }

    /**
     * Attempt the login credentials.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function process(LoginRequest $request)
    {
        try {
            $credentials = $request->credentials();
            $remember = $request->remember();

            // Check customer status
            $status = $this->customerService->getStatus($credentials);

            if (! $status) {
                throw new Exception('Akun Anda sedang tidak aktif.');
            }

            // Check auth result
            $result = auth('web')->attempt($credentials, $remember);

            if (! $result) {
                throw new Exception('Informasi login atau kata sandi tidak valid. Silahkan coba lagi.');
            }

            // Redirect to WEB home
            return ResponseController::success('Selamat datang, Anda berhasil masuk.', route('web.home'));
        }
        //
        catch (\Throwable $th) {
            return ResponseController::failed($th->getMessage());
        }
    }
}
