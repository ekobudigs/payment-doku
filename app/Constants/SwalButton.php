<?php

namespace App\Constants;

class SwalButton
{
    /**
     * OK button text for sweet alert.
     *
     * @var string
     */
    public const OK = 'OK';

    /**
     * Get all the string version of the status.
     *
     * @return array
     */
    public static function labels()
    {
        return [
            self::OK => 'OK',
        ];
    }

    /**
     * Get the string version base on key value.
     *
     * @param  string  $key
     * @return string
     */
    public static function label($key)
    {
        return self::labels()[$key];
    }
}
