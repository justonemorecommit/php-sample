<?php

use App\Auth\AuthApp;
use App\Home\HomeApp;
use Slim\Routing\RouteCollectorProxy;

$app->group('', function (RouteCollectorProxy $group) {
  $this->get('homeApp')->registerRoutes($group);
});
