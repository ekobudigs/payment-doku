<?php

namespace App\Services;

use App\Models\FAQ;

class FAQService
{
    /**
     * Default service class model.
     *
     * @var \App\Models\FAQ
     */
    protected $faq;

    /**
     * Init
     */
    public function __construct()
    {
        $this->faq = new FAQ();
    }

    /**
     * Get all faqs data.
     *
     * @return array
     */
    public function all()
    {
        return $this->faq
            // Filter status
            ->when(request()->status !== null, function ($query) {
                return $query->where('status', request()->status);
            })
            ->latest()
            ->get();
    }

    /**
     * Paginate all faqs data.
     *
     * @return array
     */
    public function paginate(int $perPage = 10)
    {
        return $this->faq
            // Filter status
            ->when(request()->status !== null, function ($query) {
                return $query->where('status', request()->status);
            })
            ->orderBy('id')
            ->paginate($perPage);
    }

    /**
     * Get faq by id.
     *
     * @param  int  $id
     * @return object
     */
    public function find($id)
    {
        return $this->faq->find($id);
    }

    /**
     * Store new faq data.
     *
     * @param  array  $credentials
     */
    public function create($credentials)
    {
        return $this->faq->create($credentials);
    }

    /**
     * Update faq data.
     *
     * @param  int  $id
     * @param  array  $credentials
     */
    public function update($id, $credentials)
    {
        return $this->find($id)->update($credentials);
    }

    /**
     * Update faq data.
     *
     * @param  int  $id
     */
    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    /**
     * Toggle faq status.
     *
     * @param  int  $id
     * @return mixed $result
     */
    public function toggleStatus($id)
    {
        $faq = $this->find($id);
        $result = $faq->update(['status' => ! $faq->status]);

        return $result;
    }
}
