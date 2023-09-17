<?php

namespace App\Integrations;

use App\Constants\HttpStatus;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class Doku
{
    /**
     * DOKU Client ID.
     *
     * @var string
     */
    private $clientId;

    /**
     * DOKU Secret Key.
     *
     * @var string
     */
    private $secretKey;

    /**
     * DOKU Base URL.
     *
     * @var string
     */
    private $baseUrl;

    /**
     * DOKU API Path.
     *
     * @var string
     */
    private $apiPath;

    /**
     * DOKU Notification URL.
     *
     * @var string
     */
    private $notificationPath;
    /**
     * DOKU Notification URL.
     *
     * @var string
     */
    private $baseUrlShopee;

    /**
     * Set DOKU Credentials.
     *
     * @return void
     */
    public function __construct()
    {
        $this->clientId = config('doku.client_id');
        $this->secretKey = config('doku.secret_key');
        $this->baseUrl = config('doku.production') ? config('doku.production_url') : config('doku.sandbox_url');
        $this->baseUrlShopee = config('doku.production') ? config('doku.production_shopee_url') : config('doku.sandbox_shopee_url');
        $this->apiPath = config('doku.api_path');
        $this->notificationPath = config('doku.notification_path');
    }

    /**
     * Verify payment data and get payment checkout URL from DOKU API.
     *
     * @param  array  $payment
     * @return array $checkout
     */
    public function checkout($data)
    {
        $data = [
            'order' => [
                'amount' => 60000,
                'invoice_number' => 'INV-001',
                'currency' => 'IDR',
                'line_items' => [
                    [
                        'id' => 'PRD-001',
                        'name' => 'Product 1',
                        'price' => 20000,
                        'quantity' => 1,
                    ],
                    [
                        'id' => 'PRD-001',
                        'name' => 'Product 2',
                        'price' => 20000,
                        'quantity' => 1,
                    ],
                    [
                        'id' => 'PRD-001',
                        'name' => 'Product 3',
                        'price' => 20000,
                        'quantity' => 1,
                    ],
                ],
                'language' => 'ID',
            ],
            'payment' => [
                'payment_due_date' => config('doku.checkout_expired'), // Minute
            ],
            'customer' => [
                'id' => 'CST-001',
                'name' => 'Eko Testing Doku',
                'email' => 'eko@gmail.com',
                'phone' => '082123456789',
            ],
        ];

        // Generate headers
        $headers = $this->generateHeaders($data);

        // Make POST request to DOKU Checkout API
        $url = $this->baseUrl . $this->apiPath;
        $response = Http::withHeaders($headers)->post($url, $data);
        $checkout = $response->json();

        if (!$checkout) {
            throw new Exception('PAYMENT_CHECKOUT_FAILED', HttpStatus::BAD_REQUEST);
        }

        return $checkout;
    }


    /**
     * Verify payment data and get payment checkout URL from DOKU API.
     *
     * @param  array  $payment
     * @return array $checkout
     */
    public function checkoutShopee($data)
    {
        $data = [
            'order' => [
                "invoice_number" => "INV-20210124-0001",
                "amount" => 150000,
                "callback_url" => "https://merchant.com/return-url",
                "expired_time" => 300
            ],

        ];

        // Generate headers
        $headers = $this->generateHeaders($data);

        // Make POST request to DOKU Checkout API
        $url = $this->baseUrlShopee . '/shopeepay-emoney/v2/order';

        $response = Http::withHeaders($headers)->post($url, $data);
        $checkout = $response->json();

        if (!$checkout) {
            throw new Exception('PAYMENT_CHECKOUT_FAILED', HttpStatus::BAD_REQUEST);
        }

        return $checkout;
    }

    /**
     * Generate DOKU headers.
     * Using example code by DOKU official github repository.
     *
     * @link https://github.com/PTNUSASATUINTIARTHA-DOKU/jokul-php-example
     *
     * @param  array  $data
     * @return array $headers
     */
    public function generateHeaders($data)
    {
        // Prepare options
        $options = [
            'data' => $data,
            'client_id' => $this->clientId,
            'request_id' => Str::random(32),
            'request_datetime' => now()->setTimezone('UTC')->format('Y-m-d\TH:i:s\Z'),
            'request_target' => '/shopeepay-emoney/v2/order',
        ];

        // Generate signature
        $signature = $this->generateSignature($options);

        $headers = [
            'Client-Id' => $options['client_id'],
            'Request-Id' => $options['request_id'],
            'Request-Timestamp' => $options['request_datetime'],
            'Signature' => $signature,
        ];

        return $headers;
    }

    /**
     * Generate DOKU signature.
     * Using example code by DOKU docs.
     *
     * @link https://dashboard.doku.com/docs/docs/http-notification/http-notification-best-practice
     *
     * @param  array  $options
     * @return string $signature
     */
    public function generateSignature($options)
    {
        // Prepare options
        $data = $options['data'];
        $clientId = $options['client_id'];
        $requestId = $options['request_id'];
        $requestDatetime = $options['request_datetime'];
        $requestTarget = $options['request_target'];

        // Generate digest
        $digest = base64_encode(hash('sha256', json_encode($data), true));

        // Prepare signature component
        $signature =
            "Client-Id:$clientId\n" .
            "Request-Id:$requestId\n" .
            "Request-Timestamp:$requestDatetime\n" .
            "Request-Target:$requestTarget\n" .
            "Digest:$digest";

        // Generate signature
        $signature = 'HMACSHA256=' . base64_encode(hash_hmac('sha256', $signature, $this->secretKey, true));

        return $signature;
    }

    /**
     * DOKU HTTP Notification.
     * Retrieve callback from DOKU.
     *
     * @return \Illuminate\Http\Response $response
     */
    public function notification(Request $request)
    {
        dd($request->all());
    }
}
