<?php

return [
    /*
    |--------------------------------------------------------------------------
    | VNPay Payment Configuration
    |--------------------------------------------------------------------------
    |
    | Cấu hình cho VNPay Payment Gateway
    |
    */

    'tmn_code' => env('VNPAY_TMN_CODE', '1VYBIYQP'),
    'hash_secret' => env('VNPAY_HASH_SECRET', 'NOH6MBGNLQL9O9OMMFMZ2AX8NIEP50W1'),
    
    'url' => [
        'sandbox' => 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html',
        'production' => 'https://vnpayment.vn/paymentv2/vpcpay.html',
    ],
    
    'environment' => env('VNPAY_ENVIRONMENT', 'sandbox'), // sandbox hoặc production
    
    'version' => '2.1.0',
    'command' => 'pay',
    'curr_code' => 'VND',
    'locale' => 'vn',
    'order_type' => 'billpayment',
    
    'timeout' => 30, // seconds
];
