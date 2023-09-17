<?php

namespace App\Http\Controllers\CMS\Modules;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Http\Requests\CMS\Audio\StoreRequest;
use App\Http\Requests\CMS\Audio\UpdateRequest;
use App\Services\AudioService;
use App\Services\FileService;
use Exception;

class AudioController extends Controller
{
    /**
     * Default service class.
     *
     * @var AudioService
     */
    protected $audioService;

    /**
     * Default service class.
     *
     * @var FileService
     */
    protected $fileService;

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
        $this->audioService = new AudioService();
        $this->fileService = new FileService();
        $this->module = 'cms.modules.audios';
        $this->title = 'Audio';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $audios = $this->audioService->paginate();
            $view = $this->module . '.index';
            $data = [
                'title' => $this->title,
                'audios' => $audios,
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
            $view = $this->module . '.create-or-edit';
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
            $audio = $request->audio();
            $audio['file_name'] = $this->fileService->uploadAudio(file: $request->audio);
            $audio['size'] = byte_to_kb($request->audio->getSize());
            $audio['extension'] = $request->audio->getClientOriginalExtension();

            // Store audio data
            $result = $this->audioService->create($audio);

            if (!$result) {
                throw new Exception('Gagal menambah data Audio, silahkan coba lagi.');
            }

            return ResponseController::success('Berhasil menambah data Audio.', route('cms.audios.index'));
        }
        //
        catch (\Throwable $th) {
            dd($th->getMessage());
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
            $audio = $this->audioService->find($id);
            $view = $this->module . '.detail';
            $data = [
                'title' => $this->title,
                'audio' => $audio,
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
            $audio = $this->audioService->find($id);
            $view = $this->module . '.create-or-edit';
            $data = [
                'title' => $this->title,
                'audio' => $audio,
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
            $audio = $request->audio();

            // Upload audio conditionally
            if ($request->audio) {
                $old = $this->audioService->find($id)->file_name;
                $audio['file_name'] = $this->fileService->uploadAudio(file: $request->audio, old: $old);
                $audio['size'] = byte_to_kb($request->audio->getSize());
                $audio['extension'] = $request->audio->getClientOriginalExtension();
            }

            // Update audio data
            $result = $this->audioService->update($id, $audio);

            if (!$result) {
                throw new Exception('Gagal mengubah data Audio, silahkan coba lagi.');
            }

            return ResponseController::success('Berhasil mengubah data Audio.', route('cms.audios.index'));
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
            // Delete audio data
            $result = $this->audioService->delete($id);

            if (!$result) {
                throw new Exception('Gagal menghapus data Audio, silahkan coba lagi.');
            }

            return ResponseController::success('Berhasil menghapus data Audio.', route('cms.audios.index'));
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
            // Toggle audio status
            $result = $this->audioService->toggleStatus($id);

            if (!$result) {
                throw new Exception('Gagal mengubah status Audio, silahkan coba lagi.');
            }

            return ResponseController::success('Berhasil mengubah status Audio.');
        }
        //
        catch (\Throwable $th) {
            return ResponseController::failed($th->getMessage());
        }
    }
}
