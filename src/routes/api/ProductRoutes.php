<?php
namespace App\Routers\Api;

global $app;
global $container;

use app\controllers\api\ProductController;
use app\middlewares\AuthMiddleware;
use Slim\Routing\RouteCollectorProxy;

$app->group('/api', function (RouteCollectorProxy $group) use ($container) {
    $productController = $container->get(ProductController::class);

    $group->get('/products', [$productController, 'index']);

})->add($container->get(AuthMiddleware::class));