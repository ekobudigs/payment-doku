<?php

return [

    /*
    |--------------------------------------------------------------------------
    | DOKU Integration Credentials.
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Client ID & Secret Key from DOKU Dashboard.
    |--------------------------------------------------------------------------
    */
    'client_id' => env('DOKU_CLIENT_ID', 'BRN-0257-1694763201449'),
    'secret_key' => env('DOKU_SECRET_KEY', 'SK-3aPs6LGhMbtqupFEj8Lg'),

    /*
    |--------------------------------------------------------------------------
    | DOKU API URL.
    |--------------------------------------------------------------------------
    */
    'sandbox_url' => env('DOKU_SANDBOX_URL', 'https://api-sandbox.doku.com'),
    'production_url' => env('DOKU_PRODUCTION_URL', 'https://api.doku.com'),


    /*
    |--------------------------------------------------------------------------
    | ShopeePay API URLs.
    |--------------------------------------------------------------------------
    */
    'sandbox_shopee_url' => env('SHOPEEPAY_SANDBOX_URL', 'https://api-sandbox.doku.com'),
    'production_shopee_url' => env('SHOPEEPAY_PRODUCTION_URL', 'https://api.doku.com'),

    /*
    |--------------------------------------------------------------------------
    | DOKU API Path, will be combined with DOKU API Base URL.
    | Example: https://api-sandbox.doku.com/checkout/v1/payment
    |--------------------------------------------------------------------------
    */
    'api_path' => env('DOKU_API_PATH', '/checkout/v1/payment'),
    'api_path_shopee' => env('DOKU_API_PATH', '/shopeepay-emoney/v2/order'),
    'notification_path' => env('DOKU_NOTIFICATION_PATH', '/api/v1.0/payment/doku/notitication'),

    /*
    |--------------------------------------------------------------------------
    | DOKU Checkout expired time in minutes.
    |--------------------------------------------------------------------------
    */
    'checkout_expired' => env('DOKU_CHECKOUT_EXPIRED', 60),

    /*
    |--------------------------------------------------------------------------
    | DOKU switch mode.
    |--------------------------------------------------------------------------
    */
    'production' => env('DOKU_PRODUCTION', false),
];
