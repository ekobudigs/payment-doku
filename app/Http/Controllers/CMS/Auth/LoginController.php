<?php

namespace App\Http\Controllers\CMS\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Http\Requests\CMS\Auth\LoginRequest;
use App\Services\AdministratorService;
use Exception;

class LoginController extends Controller
{
    /**
     * Default service class.
     *
     * @var \App\Services\AdministratorService
     */
    protected $administratorService;

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
        $this->administratorService = new AdministratorService();
        $this->module = 'cms.auth';
        $this->title = 'Login';
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

            // Check administrator status
            $status = $this->administratorService->getStatus($credentials);

            if (! $status) {
                throw new Exception('Akun Anda sedang tidak aktif.');
            }

            // Check auth result
            $result = auth('cms')->attempt($credentials);

            if (! $result) {
                throw new Exception('Informasi login atau kata sandi tidak valid. Silahkan coba lagi.');
            }

            // Redirect to CMS Dashboard
            return ResponseController::success('Selamat datang, Anda berhasil masuk.', route('cms.dashboard'));
        }
        //
        catch (\Throwable $th) {
            return ResponseController::failed($th->getMessage());
        }
    }
}
