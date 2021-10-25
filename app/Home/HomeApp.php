<?php
namespace App\Home;

use Slim\Routing\RouteCollectorProxy;
use App\Home\Controllers\HomeController;

class HomeApp {
  public function registerRoutes(RouteCollectorProxy $group) {
    $group->get('/', [HomeController::class, 'index']);
  }
}
