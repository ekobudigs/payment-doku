<?php

namespace App\Http\Controllers\WEB\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Http\Requests\WEB\Auth\RegisterRequest;
use App\Services\CustomerService;
use Exception;

class RegisterController extends Controller
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
        $this->title = 'Daftar';
    }

    /**
     * Display register page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $view = $this->module.'.register';
            $data['title'] = $this->title;

            return view($view, $data);
        }
        //
        catch (\Throwable $th) {
            return ResponseController::failed($th->getMessage());
        }
    }

    /**
     * Register new customer data.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function process(RegisterRequest $request)
    {
        try {
            $credentials = $request->credentials();

            // Check registration result
            $result = $this->customerService->create($credentials);

            if (! $result) {
                throw new Exception('Maaf, kami tidak dapat menyelesaikan pendaftaran Anda saat ini. Harap periksa informasi Anda dan coba lagi.');
            }

            // Login programmatically
            auth('web')->login($result);

            return ResponseController::success('Selamat, akun Anda telah berhasil didaftarkan', route('web.home'));
        }
        //
        catch (\Throwable $th) {
            return ResponseController::failed($th->getMessage());
        }
    }
}
