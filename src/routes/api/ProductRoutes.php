<?php
namespace App\Routers\Api;

global $app;
global $container;

use app\controllers\api\ProductController;
use app\middlewares\AuthMiddleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Slim\Routing\RouteCollectorProxy;

$app->group('/api', function (RouteCollectorProxy $group) use ($container) {
    $group->get('/products', function (Request $request, Response $response, $args) use ($container) {
        $productController = new ProductController($container->get('productService'));
        return $productController->getAll($response);
    });
})->add($container->get(AuthMiddleware::class));