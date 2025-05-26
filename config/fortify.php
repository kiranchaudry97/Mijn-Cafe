<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Fortify Rate Limiter
    |--------------------------------------------------------------------------
    |
    | Je kunt hiermee de rate limiter instellen voor Fortify-acties zoals
    | wachtwoordherstel, login en registratie.
    |
    */

    'limiter' => 'password-reset',

    /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    |
    | Fortify biedt standaard geen views. Je kunt aangeven dat je
    | eigen Blade-views gebruikt door 'views' op true te zetten.
    |
    */

    'views' => true,

    /*
    |--------------------------------------------------------------------------
    | Features
    |--------------------------------------------------------------------------
    |
    | Hier definieer je welke functionaliteiten Fortify moet inschakelen.
    | Je kunt resetPasswords, registration, emailVerification, enz. activeren.
    |
    */

    'features' => [
        'registration',
        'resetPasswords',
        'emailVerification',
    ],

    /*
    |--------------------------------------------------------------------------
    | Auth guards
    |--------------------------------------------------------------------------
    |
    | Hiermee geef je aan welke guard Fortify moet gebruiken bij authenticatie.
    |
    */

    'guard' => 'web',

    /*
    |--------------------------------------------------------------------------
    | Password broker
    |--------------------------------------------------------------------------
    |
    | De broker die gebruikt wordt voor wachtwoordherstel. Meestal is dit 'users'.
    |
    */

    'passwords' => 'users',

    /*
    |--------------------------------------------------------------------------
    | Username field
    |--------------------------------------------------------------------------
    |
    | Welk veld moet gebruikt worden voor login: 'email', 'username', enz.
    |
    */

    'username' => 'email',

    /*
    |--------------------------------------------------------------------------
    | Home redirect
    |--------------------------------------------------------------------------
    |
    | Waar wordt de gebruiker naartoe geleid na succesvolle login.
    |
    */

    'home' => '/dashboard',

    /*
    |--------------------------------------------------------------------------
    | Prefix voor routes
    |--------------------------------------------------------------------------
    |
    | Optioneel: geef een prefix voor de Fortify-routes.
    |
    */

    'prefix' => '',

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | Welke middleware gebruikt Fortify? Standaard: ['web'].
    |
    */

    'middleware' => ['web'],
];