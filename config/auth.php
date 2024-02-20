<?php

return [

    'defaults' => [
        'guard' => 'client', // or 'employee', depending on which one you want to use by default
        'passwords' => 'clients', // or 'employees'
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'client' => [
            'driver' => 'session',
            'provider' => 'clients',
        ],

        'employee' => [
            'driver' => 'session',
            'provider' => 'employees',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'clients' => [
            'driver' => 'eloquent',
            'model' => App\Models\Client::class, // make sure you have this model
        ],

        'employees' => [
            'driver' => 'eloquent',
            'model' => App\Models\Employee::class, // make sure you have this model
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'clients' => [
            'provider' => 'clients',
            'table' => 'client_password_reset_tokens', // you might want to change this
            'expire' => 60,
            'throttle' => 60,
        ],

        'employees' => [
            'provider' => 'employees',
            'table' => 'employee_password_reset_tokens', // you might want to change this
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
