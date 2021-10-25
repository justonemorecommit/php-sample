<?php

namespace App\Home\Controllers;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController {
  private $container;

  public function __construct(ContainerInterface $container)
  {
    $this->container = $container;
  }

  public function index(Request $request, Response $response) {
    return $response;
  }
}

