<?php

use DI\Container;
use Slim\Factory\AppFactory;
use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// start dependency injection service
$container = new Container();
AppFactory::setContainer($container);

$app = AppFactory::create();

require __DIR__ . '/../main/bootstrap.php';

$app->run();
