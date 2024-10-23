<?php

return [
    'basic_auth' => [
        'username' => env('WEB_BASIC_AUTH_USERNAME', 'root'),
        'password' => env('WEB_BASIC_AUTH_PASSWORD', 'toor'),
    ],
    'aws_bucket_url' => env('AWS_BUCKET_URL'),
    'setting' => [
        'max_login_fails' => env('MAX_LOGIN_FAILS', 5),
        'failed_login_retry_minutes' => env('FAILED_LOGIN_RETRY_MINUTES', 15),
    ],
    'basic_auth' => [
        'username' => env('WEB_BASIC_AUTH_USERNAME', 'telescope'),
        'password' => env('WEB_BASIC_AUTH_PASSWORD', 'epocselet'),
    ],
    'booking' => [
        'urgent_fee' => (int) env('BOOKING_URGENT_FEE', 4500)
    ]
];
