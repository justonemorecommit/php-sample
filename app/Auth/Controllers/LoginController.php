<?php

namespace App\Auth\Controllers;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Common\Controllers\AppController;
use App\Auth\Models\User;

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

    public function login(Request $request, Response $response)
    {
        $body = $request->getParsedBody();

        $user = User::checkEmailAndPassword(
            $this->em,
            $body['email'],
            $body['password']
        );

        if ($user) {
            $this->auth->setUser($user);

            return $response->withStatus(302)
                ->withHeader('Location', '/expenses');
        } else {
            $this->session->setStatus([
                'status' => 'error',
                'message' => 'Your credentials do not match.'
            ]);

            return $response->withStatus(302)
                ->withHeader('Location', '/auth/login');
        }

        return $response;
    }
}
