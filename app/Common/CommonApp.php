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
        $view = $app->getContainer()
            ->get('view');

        $view->getLoader()
            ->addPath(__DIR__ . '/Views', 'common');

        $view->addGlobal('authenticated', false);
    }
}
