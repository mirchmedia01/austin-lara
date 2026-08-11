<?php

return [

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'mail' => [
        'from' => [
            'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
            'name' => env('MAIL_FROM_NAME', env('APP_NAME')),
        ],
    ],

    'contact' => [
        'from_address' => env('MAIL_FROM_ADDRESS', 'noreply@mail.sprintmediadesign.com'),
        'from_name' => env('MAIL_FROM_NAME', env('APP_NAME')),
        'admin_emails' => array_filter(array_map('trim', explode(',', (string) env('ADMIN_EMAILS', 'abdullah.saeed1724@gmail.com,marketing@mirchmedia.com,austinoptics@gmail.com')))),
    ],

];
