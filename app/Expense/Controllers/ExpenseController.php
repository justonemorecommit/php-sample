<?php

namespace App\Expense\Controllers;

use App\Common\Controllers\AppController;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ExpenseController extends AppController
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->container = $container;
        $this->view = $this->container->get('view');
    }

    public function index(Request $request, Response $response)
    {
        echo $this->view->render('@expense/list.twig');

        return $response;
    }

    public function create(Request $request, Response $response)
    {
        echo $this->view->render('@expense/edit.twig', [
            'expense' => null
        ]);

        return $response;
    }

    public function edit(Request $request, Response $response)
    {
        echo $this->view->render('@expense/edit.twig');
    }
}
