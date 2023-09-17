<?php

namespace App\Models;

use App\Constants\GeneralStatus;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    /**
     * Table name.
     *
     * @var string
     */
    public $table = 'customers';

    /**
     * Allowed field for mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'email', 'phone', 'password', 'status',
    ];

    /**
     * Hidden field while get data.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    //

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    //

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    /**
     * Filter the active customer.
     *
     * @param object
     * @return object
     */
    public function scopeActive($query)
    {
        return $query->where('status', GeneralStatus::ACTIVE);
    }

    /**
     * Filter the inactive customer.
     *
     * @param object
     * @return object
     */
    public function scopeInactive($query)
    {
        return $query->where('status', GeneralStatus::INACTIVE);
    }
}
