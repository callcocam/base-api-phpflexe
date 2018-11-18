<?php

if (!defined('APP_DIR')):

    define('APP_DIR', __DIR__);

endif;

if (!defined('APP_BASE_URL')):

    define('APP_BASE_URL', '//api.sigasmart.com.br');

endif;

if (!defined('APP_PUBLIC_DIR')):

    define('APP_PUBLIC_DIR', 'public_html/api-sigasmart-sistema');

endif;
require __DIR__ . '/vendor/autoload.php';

$dotenv = new \Dotenv\Dotenv(__DIR__);

$dotenv->load();

session_start();


$app = new \Flexe\App();

// Run app
$app->run();