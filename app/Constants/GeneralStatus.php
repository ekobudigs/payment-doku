<?php

namespace App\Constants;

class GeneralStatus
{
    /**
     * Active status value.
     *
     * @var bool
     */
    public const ACTIVE = true;

    /**
     * Inactive status value.
     *
     * @var bool
     */
    public const INACTIVE = false;

    /**
     * Get all the string version of the status.
     *
     * @return array
     */
    public static function labels()
    {
        return [
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
        ];
    }

    /**
     * Get the string version base on int value.
     *
     * @param  int  $key
     * @return string
     */
    public static function label($key)
    {
        return self::labels()[$key];
    }

    /**
     * Get all the html version of the status.
     *
     * @return array
     */
    public static function htmlLabels()
    {
        return [
            self::ACTIVE => '<span class="badge badge-success w-100">'.self::label(self::ACTIVE).'</span>',
            self::INACTIVE => '<span class="badge badge-dark w-100">'.self::label(self::INACTIVE).'</span>',
        ];
    }

    /**
     * Get the html version base on int value.
     *
     * @param  int  $key
     * @return string
     */
    public static function htmlLabel($key)
    {
        return self::htmlLabels()[$key];
    }
}
