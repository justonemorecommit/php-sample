<?php

namespace App\Auth;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use App\Auth\Controllers\LoginController;
use App\Auth\Controllers\RegisterController;

class AuthApp
{
    public function registerRoutes(RouteCollectorProxy $group)
    {
        $group->get('/login', [LoginController::class, 'index']);
        $group->post('/login', [LoginController::class, 'login']);
        $group->get('/register', [RegisterController::class, 'index']);
        $group->post('/register', [RegisterController::class, 'register']);
    }

    public function bootstrap(App $app)
    {
        $app->getContainer()
            ->get('view')
            ->getLoader()
            ->addPath(__DIR__ . '/Views', 'auth');
    }
}
