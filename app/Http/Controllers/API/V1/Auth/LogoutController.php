<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Constants\HttpStatus;
use App\Http\Controllers\API\ResponseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Auth\LogoutRequest;
use App\Services\AdministratorService;

class LogoutController extends Controller
{
    /**
     * Default service class.
     *
     * @var \App\Services\AdministratorService
     */
    protected $administratorService;

    /**
     * Initiate controller properties value.
     */
    public function __construct()
    {
        $this->administratorService = new AdministratorService();
    }

    public function process(LogoutRequest $request)
    {
        try {
            $token = $request->user()->currentAccessToken();
            $token->delete();

            return ResponseController::success(
                code: HttpStatus::OK,
                message: __('response.auth.logout.success')
            );
        }
        //
        catch (\Throwable $error) {
            return ResponseController::failed(
                code: $error->getCode(),
                message: $error->getMessage(),
                errors: $error->getTrace(),
            );
        }
    }
}
