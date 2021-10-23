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

    'facebook' => [
        'client_id' => '462114991238338', //Facebook API
        'client_secret' => 'e639f88232e5590966c5dc8d8dd24040', //Facebook Secret
        'redirect' => 'http://127.0.0.1:8000/login',
    ],

    'google' => [
        'client_id' => '337163503121-g96resbtam0a5srgjdmprurpa42lgqcm.apps.googleusercontent.com',
        'client_secret' => '70vjJ27KuiBLMjlECOmveBZC',
        'redirect' => 'http://pod.naipod.com/login/google',
    ],
    'twitter' => [
        'client_id' => 'Z8WFQpZnabFpbDr6CJpNKVXuq',
        'client_secret' => 'N1Hb6MD2i3kykezhEytUon1MCWtNBcrVlqK0gtOWWAj1xQ1aZ6',
        'redirect' => 'http://pod.naipod.com/login/twitter',
    ],

];
