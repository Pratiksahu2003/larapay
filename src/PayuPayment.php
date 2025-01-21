<?php

namespace Larapay\Payu;

use Illuminate\Support\Facades\Http;

class PayuPayment
{
    protected $key;
    protected $salt;
    protected $baseUrl;

    public function __construct($config)
    {
        $this->key = $config['PAYU_KEY'];
        $this->salt = $config['PAYU_SALT'];
        $this->baseUrl = $config['PAYU_BASE_URL'];
    }

    public function processPayment($paymentData)
    {
        // Example API request to PayU
        $response = Http::post($this->baseUrl . '/transaction', $paymentData);

        return $response->json();
    }
}
