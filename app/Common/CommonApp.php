<?php

namespace App\Common;

use Slim\Routing\RouteCollectorProxy;
use Slim\App;

class CommonApp
{
    public function registerRoutes(RouteCollectorProxy $group)
    {
    }

    public function bootstrap(App $app)
    {
        $app->getContainer()
            ->get('view')
            ->getLoader()
            ->addPath(__DIR__ . '/Views', 'common');
    }
}
