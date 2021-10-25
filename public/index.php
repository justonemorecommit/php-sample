<?php
use DI\Container;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

// start dependency injection service
$container = new Container();
AppFactory::setContainer($container);

$app = AppFactory::create();

require __DIR__ . '/../main/apps.php';
require __DIR__ . '/../main/routes.php';

$app->run();
