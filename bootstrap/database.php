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
    "driver" => "pdo_mysql",
    "host" => "localhost",
    "port" => "3306",
    "user" => "root",
    "password" => "",
    "dbname" => "jack_dev_db"
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
