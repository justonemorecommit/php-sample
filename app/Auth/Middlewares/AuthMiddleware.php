<?php

namespace App\Auth\Middlewares;

use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class AuthMiddleware
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke(Request $request, RequestHandler $handler)
    {
        $auth = $this->container->get('auth');
        $session = $this->container->get('session');

        if (!$auth->authenticated()) {
            $response = new Response();
            $session->setStatus([
                'status' => 'error',
                'message' => 'You need to be authenticated.'
            ]);

            return $response->withStatus(302)
                ->withHeader('Location', '/auth/login');
        }

        return $handler->handle($request);
    }
}
