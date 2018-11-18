<?php
return [
    'determineRouteBeforeAppMiddleware' => false,
    'displayErrorDetails' => true,//getenv('ERROR'), // set to false in production
    'addContentLengthHeader' => getenv('LENGTH_HEADER'), // Allow the web server to send the content-length header
    // Monolog settings
    'logger' => [
        'name' => 'flexe-app',
        'path' => getenv('docker') ? 'php://stdout' :  'flexe-microservice',
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
    ],
    'path-config' => [
        'modules' => [
            'install' => [
                'Admin'=>\App\Admin\Module::class,
                'Obras'=>\App\Obras\Module::class,
                'Home'=>\App\Home\Module::class
            ],
            'vendor'=>sprintf('%s/src',APP_DIR)
        ]
    ],
    'files'=>[
            'image'=>'/dist/uploads/'
    ]

];