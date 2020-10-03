<?php

return [
    /*
    |--------------------------------------------------------------------------
    | TESSA BASE
    |--------------------------------------------------------------------------
    |
    |
    */

    // Project name. Shown in the window title.
    'project_name' => 'Tessa Admin Panel',

    // Menu logo. You can replace this with an <img> tag if you have a logo.
    'project_logo'   => "<img class='inline-block mr-2' src='".url('/logo_tessa.png')."'><span class='font-black'>Tessa</span>",

    // When clicking on the admin panel's top-left logo/name,
    // where should the user be redirected?
    // The string below will be passed through the url() helper.
    // - default: '' (project root)
    'home_link' => '',

    // Date & Datetime Format Syntax: https://carbon.nesbot.com/docs/#api-localization
    'date_format'     => 'D MMM YYYY',
    'datetime_format' => 'D MMM YYYY, HH:mm',

    // CSS files that are loaded in all pages, using Laravel's asset() helper
    'styles' => [
        '/packages/tessa/css/app.min.css',
        //'https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css'

        //Theme
        '/packages/tessa/css/color/blue-light.min.css'
    ],

    // JS files that are loaded in all pages, using Laravel's asset() helper
    'scripts' => [
        '/packages/tessa/js/app.min.js',

        //'https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js'
    ],

    // Choose whether new users/admins are allowed to register
    'registration_open' => env('TESSA_REGISTRATION_OPEN', env('APP_ENV') === 'local'),

    // The route prefix
    'route_prefix' => 'admin',

    //Auth
    'auth' => [
        'providers' => [
            'admin' => [
                'driver'  => 'eloquent',
                'model'   => \App\User::class,
            ],
        ],
        'passwords' => [
            'admin' => [
                'provider'  => 'admin',
                'table'     => 'password_resets',
                'expire'    => 240,
            ],
        ],
        'guards' => [
            'admin' => [
                'driver'   => 'session',
                'provider' => 'admin',
            ],
        ]
    ],

    //Namespace view
    'namespace_view' => 'tessa_admin',

];