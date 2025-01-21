<?php

namespace Larapay\Payu\Http\Controllers;

use App\Http\Controllers\Controller;
use Larapay\Payu\PayuPayment;

class PayuController extends Controller
{
    protected $payu;

    public function __construct(PayuPayment $payu)
    {
        $this->payu = $payu;
    }

    public function processPayment(Request $request)
    {
        // Extract payment data from the request
        $paymentData = $request->only('amount', 'product', 'user_info');

        // Process the payment
        $response = $this->payu->processPayment($paymentData);

        return response()->json($response);
    }
}
