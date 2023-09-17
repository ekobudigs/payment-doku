<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Constants\HttpStatus;
use App\Http\Controllers\API\ResponseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Auth\LoginRequest;
use App\Http\Resources\User\UserResource;
use App\Services\UserService;

class LoginController extends Controller
{
    /**
     * Default service class.
     *
     * @var UserService
     */
    protected $userService;

    /**
     * Initiate controller properties value.
     */
    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function process(LoginRequest $request)
    {
        try {
            $user = $request->validatedUser();

            // Delete previous auth token
            $user->tokens()->where('name', 'auth')->delete();

            // Generate new auth token
            $token = $user->createToken('auth')->plainTextToken;

            $data = [
                'token' => $token,
                'user' => UserResource::make($user),
            ];

            return ResponseController::success(
                code: HttpStatus::OK,
                message: __('response.auth.login.success'),
                data: $data,
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
