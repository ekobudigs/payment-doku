<?php

namespace App\Http\Controllers\CMS\Modules;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Http\Requests\CMS\Variant\StoreRequest;
use App\Http\Requests\CMS\Variant\UpdateRequest;
use App\Services\VariantService;
use Exception;

class VariantController extends Controller
{
    /**
     * Default service class.
     *
     * @var \App\Services\VariantService
     */
    protected $variantService;

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
        $this->variantService = new VariantService();
        $this->module = 'cms.modules.variants';
        $this->title = 'Paket Harga';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $variants = $this->variantService->paginate();
            $view = $this->module.'.index';
            $data = [
                'title' => $this->title,
                'variants' => $variants,
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
            $variant = $request->variant();

            // Store variant data
            $result = $this->variantService->create($variant);

            if (! $result) {
                throw new Exception('Gagal menambah data Paket Harga, silahkan coba lagi.');
            }

            return ResponseController::success('Berhasil menambah data Paket Harga.', route('cms.variants.index'));
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
            $variant = $this->variantService->find($id);
            $view = $this->module.'.detail';
            $data = [
                'title' => $this->title,
                'variant' => $variant,
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
            $variant = $this->variantService->find($id);
            $view = $this->module.'.create-or-edit';
            $data = [
                'title' => $this->title,
                'variant' => $variant,
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
            $variant = $request->variant();

            // Update variant data
            $result = $this->variantService->update($id, $variant);

            if (! $result) {
                throw new Exception('Gagal mengubah data Paket Harga, silahkan coba lagi.');
            }

            return ResponseController::success('Berhasil mengubah data Paket Harga.', route('cms.variants.index'));
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
            // Delete variant data
            $result = $this->variantService->delete($id);

            if (! $result) {
                throw new Exception('Gagal menghapus data Paket Harga, silahkan coba lagi.');
            }

            return ResponseController::success('Berhasil menghapus data Paket Harga.', route('cms.variants.index'));
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
            // Toggle variant status
            $result = $this->variantService->toggleStatus($id);

            if (! $result) {
                throw new Exception('Gagal mengubah status Variant, silahkan coba lagi.');
            }

            return ResponseController::success('Berhasil mengubah status Variant.');
        }
        //
        catch (\Throwable $th) {
            return ResponseController::failed($th->getMessage());
        }
    }
}
