<?php

namespace App\Common\Controllers;

use Psr\Container\ContainerInterface;
use Rakit\Validation\Validator;
use App\Common\Services\SessionService;
use Doctrine\ORM\EntityManager;
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

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->view = $this->container->get('view');
        $this->em = $this->container->get('em');
        $this->validator = new Validator();
        $this->session = $container->get('session');
    }
}
