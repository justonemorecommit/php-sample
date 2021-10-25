<?php

use App\Common\Services\SessionService;
use App\Auth\Services\AuthService;

$container = $app->getContainer();

// register session service
$session = new SessionService();
$session->start();
$container->set('session', function () use ($session) {
    return $session;
});

// register auth service
$auth = new AuthService($session);
$container->set('auth', function () use ($auth) {
    return $auth;
});

// register view service
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../app');
$twig = new \Twig\Environment($loader, [
    'cache' => $_ENV['APP_MODE'] === 'development'
        ? false
        : __DIR__ . '/../cache/views',
]);
$container->set('view', function () use ($session, $twig) {
    $twig->addGlobal('session', $session);

    return $twig;
});
