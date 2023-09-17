<?php

namespace App\Constants;

class DiscountType
{
    /**
     * Percentage type value.
     *
     * @var string
     */
    public const PERCENTAGE = 'PERCENTAGE';

    /**
     * Fixed type value.
     *
     * @var string
     */
    public const FIXED = 'FIXED';

    /**
     * Get all the discount type values.
     *
     * @return array
     */
    public static function values()
    {
        return [
            self::PERCENTAGE,
            self::FIXED,
        ];
    }
}
