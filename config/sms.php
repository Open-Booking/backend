<?php

return [
    'default' => env('SMS_DRIVER', 'otpsms'),

    'drivers' => [
        'smspoh' => [
            'base_url' => env('SMSPOH_BASE_URL', 'https://smspoh.com/api/v2'),
            'token' => env('SMSPOH_TOKEN', ''),
        ],
        'otpsms' => [
            'base_url' => env('OTPSMS_BASE_URL', 'https://otpsms.net/api'),
            'app_id' => env('OTPSMS_APP_ID', ''),
            'app_secret' => env('OTPSMS_APP_SECRET', ''),
        ],
    ],

    'sender' => env('SMS_SENDER', env('APP_NAME', 'OpenBooking')),
];
