<?php

namespace App\Models;

use App\Constants\GeneralStatus;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    /**
     * Model table name.
     *
     * @var string
     */
    public $table = 'variants';

    /**
     * Allowed field for mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'discount_status',
        'discount_type',
        'discount_amount',
        'allow_couple_photos',
        'allow_galleries',
        'allow_videos',
        'allow_google_maps',
        'allow_countdown',
        'allow_backsound',
        'allow_guest_book',
        'allow_guest_target',
        'allow_rsvp',
        'allow_gift',
        'max_galleries',
        'max_videos',
        'status',
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
     * Filter the active variants.
     *
     * @param object
     * @return object
     */
    public function scopeActive($query)
    {
        return $query->where('status', GeneralStatus::ACTIVE);
    }

    /**
     * Filter the inactive variants.
     *
     * @param object
     * @return object
     */
    public function scopeInactive($query)
    {
        return $query->where('status', GeneralStatus::INACTIVE);
    }
}
