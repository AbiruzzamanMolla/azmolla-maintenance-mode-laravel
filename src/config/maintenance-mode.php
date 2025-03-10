<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Route Exceptions
    |--------------------------------------------------------------------------
    |
    | Routes that should be accessible even in maintenance mode.
    |
     */

    'except'     => [
        'admin/maintenance*',
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Middleware
    |--------------------------------------------------------------------------
    |
    | The middleware to use for admin access.
    |
     */

    'middleware' => [
        'web',
        'auth',
    ],
];
