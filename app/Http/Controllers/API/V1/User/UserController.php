<?php

namespace App\Http\Controllers\API\V1\User;

use App\Constants\HttpStatus;
use App\Http\Controllers\API\ResponseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\User\StoreRequest;
use App\Http\Requests\API\V1\User\UpdateRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Services\UserService;
use Exception;

class UserController extends Controller
{
    /**
     * Default service class.
     *
     * @var UserService
     */
    protected $userService;

    /**
     * Initiate resource service class.
     */
    public function __construct()
    {
        $this->userService = new UserService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = $this->userService->paginate();
            $users = UserCollection::make($users)->response()->getData();

            return ResponseController::success(
                code: HttpStatus::OK,
                message: __('response.users.success_get_all'),
                data: $users
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            $credentials = $request->credentials();
            $user = $this->userService->create($credentials);
            $user = UserResource::make($user);

            return ResponseController::success(
                code: HttpStatus::OK,
                message: __('response.users.success_create'),
                data: $user
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = $this->userService->find($id);

            // Check user existance
            if (! $user) {
                throw new Exception(__('response.users.not_found'), HttpStatus::NOT_FOUND);
            }

            $user = UserResource::make($user);

            return ResponseController::success(
                code: HttpStatus::OK,
                message: __('response.users.success_find'),
                data: $user
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

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        try {
            $credentials = $request->credentials();
            $user = $this->userService->find($id);

            // Check user existance
            if (! $user) {
                throw new Exception(__('response.users.not_found'), HttpStatus::NOT_FOUND);
            }

            $user->update($credentials);
            $user = UserResource::make($user);

            return ResponseController::success(
                code: HttpStatus::OK,
                message: __('response.users.success_update'),
                data: $user
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = $this->userService->find($id);

            if (! $user) {
                throw new Exception(__('response.users.not_found'), HttpStatus::NOT_FOUND);
            }

            $user->delete();

            return ResponseController::success(
                code: HttpStatus::OK,
                message: __('response.users.success_delete')
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
