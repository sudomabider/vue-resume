<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Test User
    |--------------------------------------------------------------------------
    */

    'user' => [
        'name' => env('RESUME_USER_NAME', 'admin'),
        'name_alt' => env('RESUME_USER_NAME_ALT'),
        'email' => env('RESUME_USER_EMAIL'),
        'password' => env('RESUME_USER_PASSWORD')
    ],
];