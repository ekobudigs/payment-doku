<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Http\Requests\WEB\ProfileUpdateRequest;
use App\Services\CustomerService;
use Exception;

class ProfileController extends Controller
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
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
        $this->module = 'web';
        $this->title = __('auth.profile.word');
    }

    /**
     * Display profile page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $view = $this->module.'.profile';
            $data['title'] = $this->title;

            return view($view, $data);
        }
        //
        catch (\Throwable $th) {
            return ResponseController::failed($th->getMessage());
        }
    }

    /**
     * Update profile data.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request)
    {
        try {
            $credentials = $request->credentials();
            $customer = $this->customerService->find(customer()->id);

            // Check update result
            $result = $customer->update($credentials);

            if (! $result) {
                throw new Exception(__('auth.profile.update.failed'));
            }

            return ResponseController::success(__('auth.profile.update.success'));
        }
        //
        catch (\Throwable $th) {
            return ResponseController::failed($th->getMessage());
        }
    }
}
