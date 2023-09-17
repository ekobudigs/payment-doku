<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API Response Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during response for API Controller
    | messages that we need to display to the front-end developer. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'auth' => [
        'account' => [
            'inactive' => 'Akun tidak aktif.',
        ],
        'login' => [
            'success' => 'Token autentikasi berhasil dibuat.',
        ],
        'logout' => [
            'success' => 'Token autentikasi berhasil dihapus.',
        ],
    ],
    'payment' => [
        'checkout' => [
            'success' => 'Checkout pembayaran berhasil dibuat.',
        ],
        'payment_gateway' => [
            'invalid' => 'Payment gateway tidak valid.',
        ],
    ],
    'administrators' => [
        'not_found' => 'Data administrator tidak ditemukan.',
        'success_get_all' => 'Data administrators berhasil diterima.',
        'success_find' => 'Data administrator berhasil diterima.',
        'success_create' => 'Data administrator berhasil dibuat.',
        'success_update' => 'Data administrator berhasil diubah.',
        'success_delete' => 'Data administrator berhasil dihapus.',
    ],
];
