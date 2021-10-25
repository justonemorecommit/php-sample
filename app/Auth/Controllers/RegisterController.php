<?php

namespace App\Auth\Controllers;

use Psr\Container\ContainerInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use App\Auth\Models\User;
use App\Common\Controllers\AppController;

class RegisterController extends AppController
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
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
            echo $this->view->render('@auth/register.twig', [
                'errors' => $validation->errors()->firstOfAll(),
                'fields' => $request->getParsedBody()
            ]);
        }

        // check duplicated emails
        if (User::checkEmailDuplication(
            $this->em,
            $request->getParsedBody()['email']
        )) {
            echo $this->view->render('@auth/register.twig', [
                'errors' => [
                    'email' => 'The Email already exists',
                ],
                'fields' => $request->getParsedBody()
            ]);

            return $response;
        }

        $user = new User($request->getParsedBody());

        $this->em->persist($user);
        $this->em->flush();

        $this->session->setStatus([
            'type' => 'success',
            'message' => 'You are successfully registered!'
        ]);

        return $response
            ->withStatus(302)
            ->withHeader('Location', '/auth/login');
    }
}
