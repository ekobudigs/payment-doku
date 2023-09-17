<?php

namespace App\Models;

use App\Constants\GeneralStatus;
use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    /**
     * Model table name.
     *
     * @var string
     */
    public $table = 'audios';

    /**
     * Allowed field for mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'file_name', 'size', 'extension', 'status',
    ];

    /**
     * Custom data field.
     *
     * @var array
     */
    protected $appends = [
        'path'
    ];

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    /**
     * Get audio path.
     * 
     * @return string
     */
    public function getPathAttribute()
    {
        return asset('storage/uploads/audios/' . $this->file_name);
    }

    /**
     * Get size string in kilobyte.
     * 
     * @param int $size
     * @return string
     */
    public function getSizeAttribute($size)
    {
        return number_format($size) . ' KB';
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
     * Filter the active audios.
     *
     * @param object
     * @return object
     */
    public function scopeActive($query)
    {
        return $query->where('status', GeneralStatus::ACTIVE);
    }

    /**
     * Filter the inactive audios.
     *
     * @param object
     * @return object
     */
    public function scopeInactive($query)
    {
        return $query->where('status', GeneralStatus::INACTIVE);
    }
}
