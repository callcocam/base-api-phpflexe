<?php
return [
        'displayErrorDetails' => getenv('ERROR'), // set to false in production
        'addContentLengthHeader' => getenv('LENGTH_HEADER'), // Allow the web server to send the content-length header
        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => getenv('docker') ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        'db' => [
            'driver'    => env('DB_CONNECTION','mysql'),
            'host'      => env('DB_HOST','localhost'),
            'database'  => env('DB_DATABASE','slim'),
            'username'  => env('DB_USERNAME','root'),
            'password'  => env('DB_PASSWORD',''),
            'charset'   => env('DB_CHARSET','utf8'),
            'collation' => env('DB_COLLATION','utf8_unicode_ci'),
            'prefix'    => env('DB_PREFIX',''),
        ]

];