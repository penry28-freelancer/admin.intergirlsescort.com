<?php

return [
    'mode' => env('PAYPAL_MODE', 'sandbox'),
    'return_url' => env('PAYPAL_RETURN_URL', 'http://localhost:8001'),
    'cancel_url' => env('PAYPAL_CANCEL_URL', 'http://localhost:8001'),
    'sandbox' => [
        'client_id' => env('PAYPAL_SANDBOX_CLIENT_ID'),
        'secret' => env('PAYPAL_SANDBOX_CLIENT_SECRET'),
        'app_id' => env('PAYPAL_SANDBOX_APP_ID'),
    ],
    'live' => [
        'client_id' => env('PAYPAL_LIVE_CLIENT_ID'),
        'secret' => env('PAYPAL_LIVE_CLIENT_SECRET'),
        'app_id' => env('PAYPAL_LIVE_APP_ID'),
    ],
    'settings' => [
        'http.ConnectionTimeOut' => 30,
        'log.logEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'FINE'
    ],
];
