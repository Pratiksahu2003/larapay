<?php

namespace Larapay\Payu\Services;

use Illuminate\Support\Facades\Http;

class PayuService
{
    protected $key;
    protected $salt;
    protected $endpoint;

    public function __construct()
    {
        $this->key = config('payu.merchant_key');
        $this->salt = config('payu.merchant_salt');
        $this->endpoint = config('payu.endpoint');
    }

    public function initiatePayment($data)
    {
        $hashString = $this->generateHash($data);
        $data['hash'] = $hashString;
        $data['key'] = $this->key;

        // Initiating a request to PayU
        return Http::post($this->endpoint, $data);
    }

    private function generateHash($data)
    {
        $hashSequence = "{$this->key}|{$data['txnid']}|{$data['amount']}|{$data['productinfo']}|{$data['firstname']}|{$data['email']}|||||||||||{$this->salt}";
        return strtolower(hash('sha512', $hashSequence));
    }
}
