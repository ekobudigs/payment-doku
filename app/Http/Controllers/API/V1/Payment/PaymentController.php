<?php

namespace App\Http\Controllers\API\V1\Payment;

use App\Constants\HttpStatus;
use App\Constants\PaymentGateway;
use App\Http\Controllers\API\ResponseController;
use App\Http\Controllers\Controller;
use App\Integrations\Doku;
use App\Integrations\Shopee;
use Exception;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * API for making payment base on payment gateway.
     *
     * @param  Illuminate\Http\Request  $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $dokuName = PaymentGateway::DOKU;
            $shopeePayName = PaymentGateway::SHOPEEPAY;
            $gateway = $request->gateway ?? $dokuName;

            switch ($gateway) {
                case $dokuName:
                    $doku = new Doku();
                    $checkout = $doku->checkout([]);
                    $data = [
                        'checkout' => $checkout,
                    ];
                    // Redirect pengguna ke URL checkout
                    return redirect($checkout['response']['payment']['url']);

                    // return ResponseController::success(
                    //     code: HttpStatus::OK,
                    //     message: __('response.payment.checkout.success'),
                    //     data: $data
                    // );

                case $shopeePayName:
                    // dd($gateway);
                    $shopeePay = new Shopee($shopeePayName);
                    $shopeePayCheckout = $shopeePay->checkout([]); // Modify this line for ShopeePay
                    $data = [
                        'checkout' => $shopeePayCheckout, // Modify this line for ShopeePay
                    ];

                    return ResponseController::success(
                        code: HttpStatus::OK,
                        message: __('response.payment.checkout.success'),
                        data: $data
                    );


                default:
                    throw new Exception(__('response.payment.payment_gateway.invalid'));
            }
        }
        //
        catch (\Throwable $error) {
            return ResponseController::failed(
                code: $error->getCode(),
                message: $error->getMessage(),
                errors: $error->getTrace(),
            );
        }
    }




    /**
     * API for retrieving callback base on payment gateway.
     *
     * @return \Illuminate\Http\Response
     */
    public function callback(Request $request)
    {
        try {
            $dokuSlug = PaymentGateway::slug(PaymentGateway::DOKU);
            $gateway = $request->gateway ?? $dokuSlug;

            switch ($gateway) {
                case $dokuSlug:
                    $doku = new Doku();
                    $response = $doku->notification($request);

                    return ResponseController::success('PAYMENT_CALLBACK_SUCCESS', $response);
                    //
                default:
                    throw new Exception('PAYMENT_GATEWAY_INVALID');
            }
        }
        //
        catch (\Throwable $error) {
            return ResponseController::failed(
                code: $error->getCode(),
                message: $error->getMessage(),
                errors: $error->getTrace(),
            );
        }
    }
}
