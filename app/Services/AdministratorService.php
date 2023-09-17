<?php

namespace App\Services;

use App\Models\Administrator;
use Arr;
use Illuminate\Support\Facades\Hash;

class AdministratorService
{
    /**
     * Default service class model.
     *
     * @var \App\Models\Administrator
     */
    protected $administrator;

    /**
     * Init
     */
    public function __construct()
    {
        $this->administrator = new Administrator();
    }

    /**
     * Get all administrators data.
     *
     * @return array
     */
    public function all()
    {
        return $this->administrator
            // Filter status
            ->when(request()->status !== null, function ($query) {
                return $query->where('status', request()->status);
            })
            ->latest()
            ->get();
    }

    /**
     * Paginate all administrators data.
     *
     * @return array
     */
    public function paginate(int $perPage = 10)
    {
        return $this->administrator
            // Filter status
            ->when(request()->status !== null, function ($query) {
                return $query->where('status', request()->status);
            })
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Get administrator by id.
     *
     * @param  int  $id
     * @return object
     */
    public function find($id)
    {
        return $this->administrator->find($id);
    }

    /**
     * Get administrator by credentials.
     *
     * @param  array  $credentials
     * @return \App\Models\Administrator
     */
    public function findByCredentials($credentials)
    {
        return $this->administrator->where(Arr::except($credentials, 'password'));
    }

    /**
     * Store new administrator data.
     *
     * @param  array  $credentials
     */
    public function create($credentials)
    {
        return $this->administrator->create($credentials);
    }

    /**
     * Update administrator data.
     *
     * @param  int  $id
     * @param  array  $credentials
     */
    public function update($id, $credentials)
    {
        return $this->find($id)->update($credentials);
    }

    /**
     * Update administrator data.
     *
     * @param  int  $id
     */
    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    /**
     * Get administrator status.
     *
     * @param  array  $credentials
     * @return bool $status
     */
    public function getStatus($credentials)
    {
        $administrator = $this->findByCredentials($credentials)->first();
        $status = $administrator->status;

        return $status;
    }

    /**
     * Set administrator status.
     *
     * @param  array  $credentials
     * @param  bool  $status
     * @return mixed $result
     */
    public function setStatus($credentials, $status)
    {
        $administrator = $this->findByCredentials($credentials);
        $result = $administrator->update(['status' => $status]);

        return $result;
    }

    /**
     * Reset administrator password.
     *
     * @param  array  $credentials
     * @return mixed $result
     */
    public function setPassword($credentials)
    {
        $password = Hash::make($credentials['password']);
        $administrator = $this->findByCredentials($credentials);
        $result = $administrator->update(['password' => $password]);

        return $result;
    }

    /**
     * Toggle administrator status.
     *
     * @param  int  $id
     * @return mixed $result
     */
    public function toggleStatus($id)
    {
        $administrator = $this->find($id);
        $result = $administrator->update(['status' => ! $administrator->status]);

        return $result;
    }
}
