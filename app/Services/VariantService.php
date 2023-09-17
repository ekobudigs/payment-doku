<?php

namespace App\Services;

use App\Models\Variant;

class VariantService
{
    /**
     * Default service class model.
     *
     * @var \App\Models\Variant
     */
    protected $variant;

    /**
     * Init
     */
    public function __construct()
    {
        $this->variant = new Variant();
    }

    /**
     * Get all variants data.
     *
     * @return array
     */
    public function all()
    {
        return $this->variant
            // Filter status
            ->when(request()->status !== null, function ($query) {
                return $query->where('status', request()->status);
            })
            ->latest()
            ->get();
    }

    /**
     * Paginate all variants data.
     *
     * @return array
     */
    public function paginate(int $perPage = 10)
    {
        return $this->variant
            // Filter status
            ->when(request()->status !== null, function ($query) {
                return $query->where('status', request()->status);
            })
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Get variant by id.
     *
     * @param  int  $id
     * @return object
     */
    public function find($id)
    {
        return $this->variant->find($id);
    }

    /**
     * Store new variant data.
     *
     * @param  array  $credentials
     */
    public function create($credentials)
    {
        return $this->variant->create($credentials);
    }

    /**
     * Update variant data.
     *
     * @param  int  $id
     * @param  array  $credentials
     */
    public function update($id, $credentials)
    {
        return $this->find($id)->update($credentials);
    }

    /**
     * Update variant data.
     *
     * @param  int  $id
     */
    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    /**
     * Toggle variant status.
     *
     * @param  int  $id
     * @return mixed $result
     */
    public function toggleStatus($id)
    {
        $variant = $this->find($id);
        $result = $variant->update(['status' => ! $variant->status]);

        return $result;
    }
}
