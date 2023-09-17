<?php

namespace App\Http\Controllers\API;

use App\Constants\HttpStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Exceptions\HttpResponseException;

class ResponseController extends Controller
{
    /**
     * Default API response format.
     *
     * @var array
     */
    private static $response = [
        'code' => null,
        'message' => null,
    ];

    /**
     * Generating success API response.
     *
     * @param  string  $message
     * @param  array  $data
     * @param  int  $code
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function success($message = 'SUCCESS', $data = null, $code = HttpStatus::OK)
    {
        $code = $code === null || ! $code ? HttpStatus::OK : $code;

        self::$response['code'] = $code;
        self::$response['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, $code);
    }

    /**
     * Generating failed API response.
     *
     * @param  string  $message
     * @param  array  $errors
     * @param  int  $code
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function failed($message = 'FAILED', $errors = null, $code = HttpStatus::BAD_REQUEST)
    {
        $code = $code === null || ! $code ? HttpStatus::BAD_REQUEST : $code;

        self::$response['code'] = $code;
        self::$response['message'] = $message;
        self::$response['errors'] = $errors;

        $response = response()->json(self::$response, $code);

        throw new HttpResponseException($response);
    }
}
