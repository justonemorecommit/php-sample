<?php

namespace App\Expense;

use App\Auth\Middlewares\AuthMiddleware;
use Slim\Routing\RouteCollectorProxy;
use Slim\App;
use Psr\Container\ContainerInterface as Container;
use App\Expense\Controllers\ExpenseController;

class ExpenseApp
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function registerRoutes(RouteCollectorProxy $group)
    {
        $group->group('', function (RouteCollectorProxy $group) {
            $group->get('', [ExpenseController::class, 'index']);
            $group->get('/new', [ExpenseController::class, 'create']);
            $group->post('/new', [ExpenseController::class, 'store']);
            $group->get('/{id}', [ExpenseController::class, 'edit']);
            $group->post('/{id}', [ExpenseController::class, 'update']);
            $group->post('/{id}/destroy', [ExpenseController::class, 'destroy']);
        })->add(new AuthMiddleware($this->container));
    }

    public function bootstrap(App $app)
    {
        $app->getContainer()
            ->get('view')
            ->getLoader()
            ->addPath(__DIR__ . '/Views', 'expense');
    }
}
