<?php

namespace App\Auth\Controllers;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class LoginController
{
    private $container;
    private $view;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->view = $this->container->get('view');
    }

    public function index(Request $request, Response $response)
    {
        echo $this->view->render('@auth/login.twig');

        return $response;
    }
}
