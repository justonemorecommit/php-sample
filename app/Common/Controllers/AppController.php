<?php

namespace App\Common\Controllers;

use Psr\Container\ContainerInterface;
use Rakit\Validation\Validator;
use App\Common\Services\SessionService;
use App\Auth\Services\AuthService;
use Doctrine\ORM\EntityManager;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Twig\Environment as TwigEnvironment;

class AppController
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var TwigEnvironment
     */
    protected $view;

    /**
     * @var Validator
     */
    protected $validator;

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var SessionService
     */
    protected $session;

    /**
     * @var AuthService
     */
    protected $auth;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->view = $this->container->get('view');
        $this->em = $this->container->get('em');
        $this->validator = new Validator();
        $this->session = $container->get('session');
        $this->auth = $container->get('auth');
    }

    public function validate(Request $request, $rules)
    {
        $validation = $this->validator->make($request->getParsedBody(), $rules);
        $validation->validate();

        if ($validation->fails()) {
            return $validation->errors();
        }

        return null;
    }

    public function findOr404(EntityManager $em, $class, $id)
    {
        $qb = $em->createQueryBuilder();
        $qb->select('e')
            ->from($class, 'e')
            ->where('e.id=:id')
            ->setParameter('id', $id);

        $results = $qb->getQuery()->getResult();

        if (count($results) > 0)
            return $results[0];
        else {
            echo $this->view->render('@common/error_404.twig');
            return null;
        }
    }

    public function redirect(
        Response $response,
        $url,
        $status_options = null
    ) {
        if ($status_options) {
            $this->session->setStatus($status_options);
        }

        return $response->withStatus(302)
            ->withHeader('Location', $url);
    }
}
