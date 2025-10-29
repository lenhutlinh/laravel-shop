<?php

return [
    /*
    |--------------------------------------------------------------------------
    | MoMo Payment Configuration
    |--------------------------------------------------------------------------
    |
    | Cấu hình cho MoMo Payment Gateway
    |
    */

    'partner_code' => env('MOMO_PARTNER_CODE', 'MOMOBKUN20180529'),
    'access_key' => env('MOMO_ACCESS_KEY', 'klm05TvNBzhg7h7j'),
    'secret_key' => env('MOMO_SECRET_KEY', 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa'),
    
    'endpoint' => [
        'test' => 'https://test-payment.momo.vn/v2/gateway/api/create',
        'production' => 'https://payment.momo.vn/v2/gateway/api/create',
    ],
    
    'environment' => env('MOMO_ENVIRONMENT', 'test'), // test hoặc production
    
    'partner_name' => env('MOMO_PARTNER_NAME', 'Ecommerce Store'),
    'store_id' => env('MOMO_STORE_ID', 'EcommerceStore'),
    
    'request_type' => 'payWithATM',
    'lang' => 'vi',
    
    'timeout' => 30,
];
