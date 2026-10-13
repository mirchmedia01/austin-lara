<?php

return [
    'admin_emails' => array_filter(array_map('trim', explode(',', env('ADMIN_EMAILS', '')))),
    'admin_password' => env('ADMIN_PASSWORD'),
];
