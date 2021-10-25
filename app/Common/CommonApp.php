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
        $container = $app->getContainer();
        $view = $container->get('view');
        $auth = $container->get('auth');

        $view->getLoader()
            ->addPath(__DIR__ . '/Views', 'common');

        $view->addGlobal('authenticated', $auth->authenticated());
    }
}
