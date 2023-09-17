<?php

namespace App\Services;

use App\Models\Customer;
use Arr;
use Illuminate\Support\Facades\Hash;

class CustomerService
{
    /**
     * Default service class model.
     *
     * @var \App\Models\Customer
     */
    protected $customer;

    /**
     * Init
     */
    public function __construct()
    {
        $this->customer = new Customer();
    }

    /**
     * Get all customers data.
     *
     * @return array
     */
    public function all()
    {
        return $this->customer->latest()->get();
    }

    /**
     * Paginate all customers data.
     *
     * @return array
     */
    public function paginate(int $perPage = 10)
    {
        return $this->customer
            // Filter status
            ->when(request()->status !== null, function ($query) {
                return $query->where('status', request()->status);
            })
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Get customer by id.
     *
     * @param  int  $id
     * @return object
     */
    public function find($id)
    {
        return $this->customer->find($id);
    }

    /**
     * Get customers by credentials.
     *
     * @param  array  $credentials
     * @return \App\Models\Customer
     */
    public function findByCredentials($credentials)
    {
        return $this->customer->where(Arr::except($credentials, 'password'));
    }

    /**
     * Store new customer data.
     *
     * @param  array  $credentials
     */
    public function create($credentials)
    {
        return $this->customer->create($credentials);
    }

    /**
     * Update customer data.
     *
     * @param  int  $id
     * @param  array  $credentials
     */
    public function update($id, $credentials)
    {
        return $this->find($id)->update($credentials);
    }

    /**
     * Update customer data.
     *
     * @param  int  $id
     */
    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    /**
     * Get customer status.
     *
     * @param  array  $credentials
     * @return bool $status
     */
    public function getStatus($credentials)
    {
        $customer = $this->findByCredentials($credentials)->first();
        $status = $customer->status;

        return $status;
    }

    /**
     * Get customer by email.
     *
     * @param  string  $email
     * @return \App\Models\Customer
     */
    public function getByEmail($email)
    {
        return $this->customer->where('email', $email)->first();
    }

    /**
     * Set customer status.
     *
     * @param  array  $credentials
     * @param  bool  $status
     * @return mixed $result
     */
    public function setStatus($credentials, $status)
    {
        $customer = $this->findByCredentials($credentials);
        $result = $customer->update(['status' => $status]);

        return $result;
    }

    /**
     * Reset customer password.
     *
     * @param  array  $credentials
     * @return mixed $result
     */
    public function setPassword($credentials)
    {
        $password = Hash::make($credentials['password']);
        $customer = $this->findByCredentials($credentials);
        $result = $customer->update(['password' => $password]);

        return $result;
    }

    /**
     * Toggle customer status.
     *
     * @param  int  $id
     * @return mixed $result
     */
    public function toggleStatus($id)
    {
        $customer = $this->find($id);
        $result = $customer->update(['status' => ! $customer->status]);

        return $result;
    }
}
