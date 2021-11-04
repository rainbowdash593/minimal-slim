<?php
require __DIR__ . '/vendor/autoload.php';

use Slim\App;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = ['settings' => require __DIR__ . '/app/settings.php'];

$app = new App($config);

$container = $app->getContainer();

$container['logger'] = function($c) {
    $logger = new Logger('api');
    $file_handler = new StreamHandler(__DIR__ . '/logs/app.log');
    $logger->pushHandler($file_handler);
    return $logger;
};

// Register middleware
$middleware = require __DIR__ . '/app/middleware.php';
$middleware($app);

// Register routes
$routes = require __DIR__ . '/app/routes.php';
$routes($app);

// Run app
$app->run();
