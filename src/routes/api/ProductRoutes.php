<?php
namespace App\Routers\Api;

global $app;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use app\controllers\api\ProductController;

$app->get('/api/products', function (Request $request, Response $response, $args) {
    $productController = new ProductController();
    $data = $productController->getAll();

    $response = $response->withHeader('Content-Type', 'application/json');

    $response->getBody()->write(json_encode($data));

    return $response;
});

$app->get('/api/products2', function (Request $request, Response $response, $args) {
    $productController = new ProductController();
    $data = $productController->getById();

    $response = $response->withHeader('Content-Type', 'application/json');

    $response->getBody()->write(json_encode($data));

    return $response;
});