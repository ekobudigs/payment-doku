<?php

namespace App\Services;

use App\Models\Audio;

class AudioService
{
    /**
     * Default service class model.
     *
     * @var \App\Models\Audio
     */
    protected $audio;

    /**
     * Init
     */
    public function __construct()
    {
        $this->audio = new Audio();
    }

    /**
     * Get all audios data.
     *
     * @return array
     */
    public function all()
    {
        return $this->audio
            // Filter status
            ->when(request()->status !== null, function ($query) {
                return $query->where('status', request()->status);
            })
            ->latest()
            ->get();
    }

    /**
     * Paginate all audios data.
     *
     * @return array
     */
    public function paginate(int $perPage = 10)
    {
        return $this->audio
            // Filter status
            ->when(request()->status !== null, function ($query) {
                return $query->where('status', request()->status);
            })
            ->orderBy('id')
            ->paginate($perPage);
    }

    /**
     * Get audio by id.
     *
     * @param  int  $id
     * @return object
     */
    public function find($id)
    {
        return $this->audio->find($id);
    }

    /**
     * Store new audio data.
     *
     * @param  array  $credentials
     */
    public function create($credentials)
    {
        return $this->audio->create($credentials);
    }

    /**
     * Update audio data.
     *
     * @param  int  $id
     * @param  array  $credentials
     */
    public function update($id, $credentials)
    {
        return $this->find($id)->update($credentials);
    }

    /**
     * Update audio data.
     *
     * @param  int  $id
     */
    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    /**
     * Toggle audio status.
     *
     * @param  int  $id
     * @return mixed $result
     */
    public function toggleStatus($id)
    {
        $audio = $this->find($id);
        $result = $audio->update(['status' => ! $audio->status]);

        return $result;
    }
}
