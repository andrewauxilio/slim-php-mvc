<?php

use app\controllers\api\ProductController;
use DI\Container;
use Slim\Factory\AppFactory;
use app\services\DatabaseService;

$container = new Container();
AppFactory::setContainer($container);

// Register services, such as database, logger, etc.
$container->set('database', function () {
    return new DatabaseService();
});

$container->set('productController', function ($container) {
    return new ProductController($container->get('database'));
});