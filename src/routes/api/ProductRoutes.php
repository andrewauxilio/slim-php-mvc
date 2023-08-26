<?php
namespace App\Routers\Api;

global $app;
global $container;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use app\controllers\api\ProductController;

$app->get('/api/products', function (Request $request, Response $response, $args) use ($container) {
    $productController = $container->get('productController');
    $data = $productController->getAll();

    $response = $response->withHeader('Content-Type', 'application/json');
    $response->getBody()->write(json_encode($data));

    return $response;
});