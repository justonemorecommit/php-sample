<?php

namespace App\Auth\Controllers;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Rakit\Validation\Validator;

class RegisterController
{
    private $container;
    private $view;
    private $validator;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->view = $this->container->get('view');
        $this->validator = new Validator();
    }

    public function index(Request $request, Response $response)
    {
        echo $this->view->render('@auth/register.twig');

        return $response;
    }

    public function register(Request $request, Response $response)
    {
        $validation = $this->validator->make($request->getParsedBody(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        $validation->validate();

        if ($validation->fails()) {
            var_dump($request->getParsedBody());
            echo $this->view->render('@auth/register.twig', [
                'errors' => $validation->errors()->firstOfAll(),
                'fields' => $request->getParsedBody()
            ]);
        }

        return $response;
    }
}
