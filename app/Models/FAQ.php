<?php

namespace App\Models;

use App\Constants\GeneralStatus;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    /**
     * Model table name.
     *
     * @var string
     */
    public $table = 'faqs';

    /**
     * Allowed field for mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'question', 'answer', 'status',
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
     * Filter the active faqs.
     *
     * @param object
     * @return object
     */
    public function scopeActive($query)
    {
        return $query->where('status', GeneralStatus::ACTIVE);
    }

    /**
     * Filter the inactive faqs.
     *
     * @param object
     * @return object
     */
    public function scopeInactive($query)
    {
        return $query->where('status', GeneralStatus::INACTIVE);
    }
}
