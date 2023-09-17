<?php

namespace App\Http\Controllers\WEB\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Http\Requests\WEB\Auth\ForgotPasswordRequest;
use App\Http\Requests\WEB\Auth\ResetPasswordRequest;
use App\Mail\WEB\Auth\ForgotPasswordMail;
use App\Services\CustomerService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
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
     * Initiate resource service class.
     */
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
        $this->module = 'web.auth';
        $this->title = 'Forgot Password';
    }

    /**
     * Display forgot password page.
     *
     * @param  \App\Http\Requests  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $view = $this->module.'.forgot-password';
            $data = [
                'title' => $this->title,
                'email' => $request->email,
            ];

            return view($view, $data);
        }
        //
        catch (\Throwable $th) {
            return ResponseController::failed($th->getMessage());
        }
    }

    /**
     * Send email with forgot password request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(ForgotPasswordRequest $request)
    {
        try {
            $credentials = $request->credentials();

            Mail::queue(new ForgotPasswordMail($credentials));

            return ResponseController::success(__('auth.password_reset.sent'), route('web.auth.login.index', app()->getLocale()));
        }
        //
        catch (\Throwable $th) {
            return ResponseController::failed($th->getMessage());
        }
    }

    /**
     * Reset the administrator password.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(ResetPasswordRequest $request)
    {
        try {
            $credentials = $request->credentials();
            $result = $this->customerService->setPassword($credentials);

            if (! $result) {
                throw new Exception(__('auth.password_reset.failed'));
            }

            return ResponseController::success(__('auth.password_reset.success'), route('web.auth.login.index', app()->getLocale()));
        }
        //
        catch (\Throwable $th) {
            return ResponseController::failed($th->getMessage());
        }
    }
}
