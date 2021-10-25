<?php

namespace App\Home;

use Slim\Routing\RouteCollectorProxy;
use App\Home\Controllers\HomeController;
use Slim\App;

class HomeApp
{
    public function registerRoutes(RouteCollectorProxy $group)
    {
        $group->get('', [HomeController::class, 'index']);
    }

    public function bootstrap(App $app)
    {
        $app->getContainer()
            ->get('view')
            ->getLoader()
            ->addPath(__DIR__ . '/Views', 'home');
    }
}
