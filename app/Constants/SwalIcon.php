<?php

namespace App\Constants;

class SwalIcon
{
    /**
     * Success icons for sweet alert.
     *
     * @var string
     */
    public const SUCCESS = 'success';

    /**
     * Failed icons for sweet alert.
     *
     * @var string
     */
    public const ERROR = 'error';

    /**
     * Warning icons for sweet alert.
     *
     * @var string
     */
    public const WARNING = 'warning';

    /**
     * Info icons for sweet alert.
     *
     * @var string
     */
    public const INFO = 'info';

    /**
     * Question icons for sweet alert.
     *
     * @var string
     */
    public const QUESTION = 'question';

    /**
     * Get all the string version of the status.
     *
     * @return array
     */
    public static function labels()
    {
        return [
            self::SUCCESS => 'Success',
            self::ERROR => 'Failed',
            self::WARNING => 'Warning',
            self::INFO => 'Info',
            self::QUESTION => 'Confirmation',
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
