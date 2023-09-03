<?php
// bootstrap.php
require_once "../vendor/autoload.php";

use Doctrine\DBAL\DriverManager;
// use Doctrine\ORM\EntityManager;
// use Doctrine\ORM\ORMSetup;

// $paths = ['/path/to/entity-files'];
// $isDevMode = false;

// // the connection configuration
// $dbParams = [
//     'driver'   => 'pdo_mysql',
//     'user'     => 'root',
//     'password' => '',
//     'dbname'   => 'foo',
// ];

// $config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
// $connection = DriverManager::getConnection($dbParams, $config);
// $entityManager = new EntityManager($connection, $config);


$connectionParams = [
    'dbname' => 'mydb',
    'user' => 'user',
    'password' => 'secret',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];
$conn = DriverManager::getConnection($connectionParams);