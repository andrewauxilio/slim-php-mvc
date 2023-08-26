<?php
namespace App\Routers\Api;

global $app;
global $container;

use app\middlewares\AuthMiddleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Slim\Routing\RouteCollectorProxy;

$app->group('/api', function (RouteCollectorProxy $group) use ($container) {
    $group->get('/products', function (Request $request, Response $response, $args) use ($container) {
        $productController = $container->get('productController');
        $data = $productController->getAll();

        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode($data));

        return $response;
    });

    $group->get('/products2', function (Request $request, Response $response, $args) use ($container) {
        $productController = $container->get('productController');
        $data = $productController->getAll();

        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode($data));

        return $response;
    });
})->add(AuthMiddleware::class);