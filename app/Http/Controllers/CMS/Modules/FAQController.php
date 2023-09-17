<?php

namespace App\Http\Controllers\CMS\Modules;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Http\Requests\CMS\FAQ\StoreRequest;
use App\Http\Requests\CMS\FAQ\UpdateRequest;
use App\Services\FAQService;
use Exception;

class FAQController extends Controller
{
    /**
     * Default service class.
     *
     * @var \App\Services\FAQService
     */
    protected $faqService;

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
        $this->faqService = new FAQService();
        $this->module = 'cms.modules.faqs';
        $this->title = 'FAQ';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $faqs = $this->faqService->paginate();
            $view = $this->module.'.index';
            $data = [
                'title' => $this->title,
                'faqs' => $faqs,
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
            $faq = $request->faq();

            // Store faq data
            $result = $this->faqService->create($faq);

            if (! $result) {
                throw new Exception('Gagal menambah data FAQ, silahkan coba lagi.');
            }

            return ResponseController::success('Berhasil menambah data FAQ.', route('cms.faqs.index'));
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
            $faq = $this->faqService->find($id);
            $view = $this->module.'.detail';
            $data = [
                'title' => $this->title,
                'faq' => $faq,
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
            $faq = $this->faqService->find($id);
            $view = $this->module.'.create-or-edit';
            $data = [
                'title' => $this->title,
                'faq' => $faq,
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
            $faq = $request->faq();

            // Update faq data
            $result = $this->faqService->update($id, $faq);

            if (! $result) {
                throw new Exception('Gagal mengubah data FAQ, silahkan coba lagi.');
            }

            return ResponseController::success('Berhasil mengubah data FAQ.', route('cms.faqs.index'));
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
            // Delete faq data
            $result = $this->faqService->delete($id);

            if (! $result) {
                throw new Exception('Gagal menghapus data FAQ, silahkan coba lagi.');
            }

            return ResponseController::success('Berhasil menghapus data FAQ.', route('cms.faqs.index'));
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
            // Toggle faq status
            $result = $this->faqService->toggleStatus($id);

            if (! $result) {
                throw new Exception('Gagal mengubah status FAQ, silahkan coba lagi.');
            }

            return ResponseController::success('Berhasil mengubah status FAQ.');
        }
        //
        catch (\Throwable $th) {
            return ResponseController::failed($th->getMessage());
        }
    }
}
