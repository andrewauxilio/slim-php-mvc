<?php
namespace App\Routers\Api;

global $app;
global $container;

use app\controllers\api\AuthController;
use app\middlewares\AuthMiddleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Slim\Routing\RouteCollectorProxy;

$app->group('/api', function (RouteCollectorProxy $group) use ($container) {
    $group->post('/auth/login', function (Request $request, Response $response, $args) use ($container) {
        $authController = new AuthController($container->get('authService'));

        return $authController->login($request, $response);
    });

    $group->post('/auth/register', function (Request $request, Response $response, $args) use ($container) {
        $authController = new AuthController($container->get('authService'));

        return $authController->register($request, $response);
    });
})->add(AuthMiddleware::class);