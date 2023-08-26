<?php

use app\services\auth\AuthService;
use app\services\DatabaseService;
use app\services\product\ProductService;
use DI\Container;
use Slim\Factory\AppFactory;

$container = new Container();
AppFactory::setContainer($container);

// Register services, such as database, logger, etc.
$container->set('database', function () {
    return new DatabaseService();
});

$container->set('productService', function ($container) {
    return new ProductService($container->get('database'));
});

$container->set('authService', function ($container) {
    return new AuthService($container->get('database'));
});