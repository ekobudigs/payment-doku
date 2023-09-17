<?php

namespace App\Models;

use App\Constants\GeneralStatus;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Administrator extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * Model table name.
     *
     * @var string
     */
    public $table = 'administrators';

    /**
     * Allowed field for mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'email', 'phone', 'password', 'avatar', 'status',
    ];

    /**
     * Hidden field while get data.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * New field for the result.
     *
     * @var array
     */
    protected $append = [
        'avatar_path',
    ];

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    /**
     * Get administrator avatar image path | src.
     *
     * @return string
     */
    public function getAvatarPathAttribute()
    {
        return asset('storage/uploads/images/avatars/default.png');
    }

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
     * Filter the active administrator.
     *
     * @param object
     * @return object
     */
    public function scopeActive($query)
    {
        return $query->where('status', GeneralStatus::ACTIVE);
    }

    /**
     * Filter the inactive administrator.
     *
     * @param object
     * @return object
     */
    public function scopeInactive($query)
    {
        return $query->where('status', GeneralStatus::INACTIVE);
    }
}
