<?php

use Psr\Container\ContainerInterface;
use App\Common\Services\SessionService;

$container = $app->getContainer();

// register session service
$session = new SessionService();
$session->start();
$container->set('session', function () use ($session) {
    return $session;
});

// register view service
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../app');
$twig = new \Twig\Environment($loader, [
    'cache' => $_ENV['APP_MODE'] === 'development'
        ? false
        : __DIR__ . '/../cache/views',
]);
// register view service
$container->set('view', function () use ($session, $twig) {
    $twig->addGlobal('session', $session);

    return $twig;
});
