<?php

use Psr\Container\ContainerInterface;

$container = $app->getContainer();

$container->set('view', function (ContainerInterface $container) {
    $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../app');
    $twig = new \Twig\Environment($loader, [
        'cache' => $_ENV['APP_MODE'] === 'development'
            ? false
            : __DIR__ . '/../cache/views',

    ]);

    return $twig;
});
