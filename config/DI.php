<?php

use app\controllers\api\AuthController;
use app\middlewares\AuthMiddleware;
use app\services\auth\AuthService;
use app\services\DatabaseService;
use app\services\product\ProductService;
use DI\Container;
use Slim\Factory\AppFactory;

$container = new Container();
AppFactory::setContainer($container);

$container->set(DatabaseService::class, function () {
    return new DatabaseService();
});

// middlewares
$container->set(AuthMiddleware::class, function ($container) {
    return new AuthMiddleware($container->get(DatabaseService::class));
});

// services
$container->set(ProductService::class, function ($container) {
    return new ProductService($container->get(DatabaseService::class));
});

$container->set(AuthService::class, function ($container) {
    return new AuthService($container->get(DatabaseService::class));
});

// controllers
$container->set(AuthController::class, function ($container) {
    return new AuthController($container->get(AuthService::class));
});