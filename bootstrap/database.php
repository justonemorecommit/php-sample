<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$isDevMode = true;

$paths = [__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'app'];

$config = Setup::createAnnotationMetadataConfiguration(
    $paths,
    $isDevMode,
);

// database configuration parameters
$conn = array(
    "driver" => $_ENV['DB_DRIVER'] ?? "pdo_mysql",
    "host" => $_ENV['DB_HOST'] ?? "localhost",
    "port" => $_ENV['DB_PORT'] ?? "3306",
    "user" => $_ENV['DB_USER'] ?? "root",
    "password" => $_ENV['DB_PASSWORD'] ?? "",
    "dbname" => $_ENV['DB_NAME'] ?? "jack_dev_db"
);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);

$container = $app->getContainer();

$container->set('em', function () use ($entityManager) {
    return $entityManager;
});

$container->set('entityManager', function () use ($entityManager) {
    return $entityManager;
});
