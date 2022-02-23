<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'github' => [
        'client_id' => '5bcd729a2f3ec133d5bb', //Github API
        'client_secret' => '77fcc3df0ba59dc0fde6824a5986201de4d97be5', //Github Secret
        'redirect' => 'http://localhost:8000/login/github/callback',
     ],
     'google' => [
        'client_id' => '436002598696-t9jb3vkrfdj0tgsr9qbjfl1nlgat77mp.apps.googleusercontent.com', //Google API
        'client_secret' => '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', //Google Secret
        'redirect' => 'http://localhost:8000/login/google/callback',
     ],
    //  'facebook' => [
    //     'client_id' => '337079601254114', //Facebook API
    //     'client_secret' => '97dbb1e36afc89a2e8ccf50c3c4a3958', //Facebook Secret
    //     'redirect' => 'http://localhost:8000/login/facebook/callback',
    //  ],

];
