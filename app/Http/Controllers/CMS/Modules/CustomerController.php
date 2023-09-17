<?php

namespace App\Http\Controllers\CMS\Modules;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Http\Requests\CMS\Customer\StoreRequest;
use App\Http\Requests\CMS\Customer\UpdateRequest;
use App\Services\CustomerService;
use Exception;

class CustomerController extends Controller
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
     * @var array
     */
    private $title;

    /**
     * Initiate resource service class.
     */
    public function __construct()
    {
        $this->customerService = new CustomerService();
        $this->module = 'cms.modules.customers';
        $this->title = 'Pelanggan';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $customers = $this->customerService->paginate();
            $view = $this->module.'.index';
            $data = [
                'title' => $this->title,
                'customers' => $customers,
            ];

            return view($view, $data);
        }
        //
        catch (\Throwable $th) {
            return ResponseController::failed($th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $view = $this->module.'.create-or-edit';
            $data = [
                'title' => $this->title,
                'edit' => false,
            ];

            return view($view, $data);
        }
        //
        catch (\Throwable $th) {
            return ResponseController::failed($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $credentials = $request->credentials();

            // Store customer data
            $result = $this->customerService->create($credentials);

            if (! $result) {
                throw new Exception('Gagal menambah data Pelanggan, silahkan coba lagi.');
            }

            return ResponseController::success('Berhasil menambah data Pelanggan.', route('cms.customers.index'));
        }
        //
        catch (\Throwable $th) {
            return ResponseController::failed($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $customer = $this->customerService->find($id);
            $view = $this->module.'.detail';
            $data = [
                'title' => $this->title,
                'customer' => $customer,
            ];

            return view($view, $data);
        }
        //
        catch (\Throwable $th) {
            return ResponseController::failed($th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $customer = $this->customerService->find($id);
            $view = $this->module.'.create-or-edit';
            $data = [
                'title' => $this->title,
                'customer' => $customer,
                'edit' => true,
            ];

            return view($view, $data);
        }
        //
        catch (\Throwable $th) {
            return ResponseController::failed($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $credentials = $request->credentials();

            // Update customer data
            $result = $this->customerService->update($id, $credentials);

            if (! $result) {
                throw new Exception('Gagal mengubah data Pelanggan, silahkan coba lagi.');
            }

            return ResponseController::success('Berhasil mengubah data Pelanggan.', route('cms.customers.index'));
        }
        //
        catch (\Throwable $th) {
            return ResponseController::failed($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Delete customer data
            $result = $this->customerService->delete($id);

            if (! $result) {
                throw new Exception('Gagal menghapus data Pelanggan.');
            }

            return ResponseController::success('Berhasil menghapus data Pelanggan.', route('cms.customers.index'));
        }
        //
        catch (\Throwable $th) {
            return ResponseController::failed($th->getMessage());
        }
    }

    /**
     * Change the specified resource status.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggle($id)
    {
        try {
            // Toggle customer status
            $result = $this->customerService->toggleStatus($id);

            if (! $result) {
                throw new Exception('Gagal mengubah status Pelanggan, silahkan coba lagi.');
            }

            return ResponseController::success('Berhasil mengubah status Pelanggan.');
        }
        //
        catch (\Throwable $th) {
            return ResponseController::failed($th->getMessage());
        }
    }
}
