<?php

use Carbon\Carbon;

/**
 * Date format.
 *
 * @var string
 */
const DATE_FORMAT = 'l, j F Y';

/**
 * Time format.
 *
 * @var string
 */
const TIME_FORMAT = 'h:i A';

/**
 * Date and Time format.
 *
 * @var string
 */
const DATE_TIME_FORMAT = DATE_FORMAT . ' ' . TIME_FORMAT;

/**
 * Get authenticated user (web).
 *
 * @return \App\Models\Customer
 */
if (!function_exists('customer')) {
    function customer()
    {
        return auth('web')->user();
    }
}

/**
 * Get authenticated user (cms).
 *
 * @return \App\Models\Administrator
 */
if (!function_exists('administrator')) {
    function administrator()
    {
        return auth('cms')->user();
    }
}

/**
 * Format date for general human.
 *
 * @param  string  $datetime
 * @param  string  $locale
 * @return string  $date
 */
if (!function_exists('human_date')) {
    function human_date($datetime, $locale = null)
    {
        $carbon = Carbon::make($datetime);
        $carbon->setLocale($locale);
        $carbon->settings(['formatFunction' => 'translatedFormat']);
        $date = $carbon->format(DATE_FORMAT);

        return $date;
    }
}

/**
 * Format time for general human.
 *
 * @param  string  $datetime
 * @param  string  $locale
 * @return string  $time
 */
if (!function_exists('human_time')) {
    function human_time($datetime, $locale = null)
    {
        $carbon = Carbon::make($datetime);
        $carbon->setLocale($locale);
        $carbon->settings(['formatFunction' => 'translatedFormat']);
        $time = $carbon->format(TIME_FORMAT);

        return $time;
    }
}

/**
 * Format datetime for general human.
 *
 * @param  string  $datetime
 * @param  string  $locale
 * @return string  $datetime
 */
if (!function_exists('human_datetime')) {
    function human_datetime($datetime, $locale = null)
    {
        $carbon = Carbon::make($datetime);
        $carbon->setLocale($locale);
        $carbon->settings(['formatFunction' => 'translatedFormat']);
        $datetime = $carbon->format(DATE_TIME_FORMAT);

        return $datetime;
    }
}

/**
 * Format date diff for human.
 *
 * @param  string  $datetime
 * @param  string  $locale
 * @return string  $diff
 */
if (!function_exists('human_datetime_diff')) {
    function human_datetime_diff($datetime, $locale = null)
    {
        $carbon = Carbon::make($datetime);
        $carbon->setLocale($locale);
        $diff = $carbon->diffForHumans();

        return $diff;
    }
}

/**
 * Determine if a string is an email.
 *
 * @param  string  $string
 * @return bool $result
 */
if (!function_exists('is_email')) {
    function is_email($string)
    {
        // Email regular expression pattern
        $pattern = '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/';
        $result = preg_match($pattern, $string);

        return $result;
    }
}

/**
 * Determine if a string is a phone number.
 *
 * @param  string  $string
 * @return bool $result
 */
if (!function_exists('is_phone')) {
    function is_phone($string)
    {
        // Phone number regular expression pattern
        $pattern = '/^\+?[1-9]\d{1,14}$/';
        $result = preg_match($pattern, $string);

        return $result;
    }
}

/**
 * Normalize phone number format (+62).
 *
 * @param  string  $phone
 * @return string  $phone
 */
if (!function_exists('normalize_phone')) {
    function normalize_phone($phone)
    {
        // Remove any non-digit characters from the phone number
        $phone = preg_replace('/\D/', '', $phone);

        // Check if the phone number starts with '0'
        if (substr($phone, 0, 1) === '0') {
            // Replace the leading '0' with '+62'
            $phone = '+62' . substr($phone, 1);
        }

        // Check if the phone number starts with '62'
        if (substr($phone, 0, 2) === '62') {
            // Replace the leading '62' with '+62'
            $phone = '+' . $phone;
        }

        return $phone;
    }
}

/**
 * Convert number to IDR currency.
 *
 * @param  int  $number
 * @return string
 */
if (!function_exists('number_to_idr')) {
    function number_to_idr($number)
    {
        return 'Rp. ' . number_format($number, 0, ',', '.');
    }
}

/**
 * Convert byte to kilobyte.
 *
 * @param  int  $byte
 * @return int
 */
if (!function_exists('byte_to_kb')) {
    function byte_to_kb($byte)
    {
        return (int) ceil($byte / 1024);
    }
}
