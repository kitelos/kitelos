<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
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

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],

    'facebook' => [
        'client_id'     =>  '354158125055635',
        'client_secret' =>  'e1efc39a1cf47092f25a8a164b756c40',
        'redirect'      =>  env('APP_URL', 'https://mascodigo.com.bo').'/auth/facebook/callback'
    ],

    'google' => [
        'client_id'     =>  '37177555957-na2qfo4nfcsopfhvhablhq1cdn6c6dp8.apps.googleusercontent.com',
        'client_secret' =>  'aI0OybCwU7nypwcTTCDhV8kg',
        'redirect'      =>  env('APP_URL', 'https://mascodigo.com.bo').'/auth/google/callback',
    ],

    'twitter'   =>  [
        'client_id'     =>  '6TPDpJAcK4ThXJlSq3inZjuMZ',
        'client_secret' =>  'YYyvwHoHebZlsV9ENvCTjus0O92sNqIjI955iTJOoTcg1S5G3b',
        'redirect'      =>  env('APP_URL', 'https://mascodigo.com.bo').'/auth/twitter/callback'
    ],

    'github'  =>  [
        'client_id'     =>  '5fd70c6c5f4dbb52729a',
        'client_secret' =>  '7391dd517fe154b03e3bbc6998dc88073c476168',
        'redirect'      =>  env('APP_URL', 'https://mascodigo.com.bo').'/auth/github/callback'
    ],

];
