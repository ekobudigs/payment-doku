<?php

namespace App\Constants;

class OAuthDriver
{
    /**
     * Google driver value.
     *
     * @var string
     */
    public const GOOGLE = 'google';

    /**
     * Get all the string version of the value.
     *
     * @return array
     */
    public static function labels()
    {
        return [
            self::GOOGLE => 'Google',
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

    /**
     * Get all the html version of the status.
     *
     * @return array
     */
    public static function htmlLabels()
    {
        return [
            self::GOOGLE => '<i class="fa-brands fa-google"></i> '.self::label(self::GOOGLE),
        ];
    }

    /**
     * Get the html version base on key value.
     *
     * @param  string  $key
     * @return string
     */
    public static function htmlLabel($key)
    {
        return self::htmlLabels()[$key];
    }
}
