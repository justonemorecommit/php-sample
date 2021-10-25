<?php

namespace App\Auth\Controllers;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Common\Controllers\AppController;

class LoginController extends AppController
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }

    public function index(Request $request, Response $response)
    {
        echo $this->view->render('@auth/login.twig');

        return $response;
    }
}
