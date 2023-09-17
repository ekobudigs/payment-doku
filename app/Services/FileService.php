<?php

namespace App\Services;

use File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FileService
{
    /**
     * Public file storage.
     *
     * @var Storage
     */
    private $storage;

    /**
     * Initiate class value
     */
    public function __construct()
    {
        $this->storage = Storage::disk('public');
    }

    /**
     * Upload an image file with Intervention Image.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  string  $directory
     * @param  string  $old
     * @return string  $name
     */
    public function uploadImage($file, $directory = '', $old = null)
    {
        // Prepare meta data
        $extension = 'webp';
        $name = time() . '.' . $extension;
        $basePath = storage_path('app/public/uploads/images');
        $path = $basePath . '/' . $directory;

        // Verify directory existance
        $this->verifyPath($path);

        // Save new image
        Image::make($file)->encode($extension)->save($path . '/' . $name);

        // Remove old image if exist
        $this->remove($path, $old);

        return $name;
    }

    /**
     * Upload an audio file with Storage class.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  string  $directory
     * @param  string  $old
     * @return string  $name
     */
    public function uploadAudio($file, $directory = null, $old = null)
    {
        // Prepare meta data
        $extension = $file->getClientOriginalExtension();
        $name = time() . '.' . $extension;
        $basePath = '/uploads/audios';
        $path = $basePath . '/' . $directory;

        // Verify directory existance
        $this->verifyPath($path);

        // Save new audio
        $this->storage->putFileAs($path, $file, $name);

        // Remove old audio if exist
        $this->remove(storage_path('app/public/' . $path), $old);
        
        return $name;
    }

    /**
     * Remove file if exist.
     *
     * @param  string  $path
     * @param  string|null  $name
     * @return void
     */
    public function remove($path, $name)
    {
        if ($name) {
            $path = $path . '/' . $name;
            if (file_exists($path)) {
                File::delete($path);
            }
        }
    }

    /**
     * Verify path existance.
     * 
     * @param string $path
     * @return void
     */
    public function verifyPath($path)
    {
        // Verify directory existance
        if (!$this->storage->directoryExists($path)) {
            // Make directory if not exists
            $this->storage->makeDirectory($path);
        }
    }
}
