<?php

use Slim\Routing\RouteCollectorProxy;

$app->group('/auth', function (RouteCollectorProxy $group) {
    $this->get('authApp')->registerRoutes($group);
});

$app->group('/', function ($group) {
    $this->get('homeApp')->registerRoutes($group);
});
