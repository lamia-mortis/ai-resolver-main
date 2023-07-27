<?php

declare(strict_types=1);

use App\Services\Enums\MicroServices;

return [

    /** Custom MicroServices */
    MicroServices::mind() => [
        'url' => [
            'protocol' => env('MIND_MICROSERVICE_PROTOCOL', 'http'),
            'host'     => env('MIND_MICROSERVICE_HOST', 'ai-resolver-mind-ms'),
            'port'     => env('MIND_MICROSERVICE_PORT', 8888),
        ],
    ],

    /** Third Party Services */
    'mailgun' => [
        'domain'   => env('MAILGUN_DOMAIN'),
        'secret'   => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme'   => 'https',
    ],

    'postmark'  => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key'    => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
