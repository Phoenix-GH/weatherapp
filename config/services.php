<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'authy' => [
        'secret' => env('AUTHY_SECRET'),
    ],

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'smartystreets' => [
		'key' => env('SS_KEY'),
		'auth_id' => env('SS_AUTH_ID'),
		'auth_token' => env('SS_AUTH_TOKEN'),
    ],

    'twilio' => [
    	'account_sid' => env('TWILIO_SID'),
	    'auth_token' => env('TWILIO_AUTH'),
	    'from' => env('TWILIO_FROM')
    ],

    'google' => [
        'tracking_id' => env('GOOGLE_ANALYTICS_TRACKING'),
        'auth_token' => env('TWILIO_AUTH'),
    ],

    'mixpanel' => [
        'id' =>env('MIXPANEL_ID'),
    ],
];
