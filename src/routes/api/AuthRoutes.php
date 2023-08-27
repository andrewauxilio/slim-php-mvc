<?php
namespace App\Routers\Api;

global $app;
global $container;

use app\controllers\api\AuthController;
use app\middlewares\AuthMiddleware;
use Slim\Routing\RouteCollectorProxy;

$app->group('/api', function (RouteCollectorProxy $group) use ($container) {
    $authController = $container->get(AuthController::class);

    $group->post('/auth/login', [$authController, 'login']);
    $group->post('/auth/register', [$authController, 'register']);

})->add($container->get(AuthMiddleware::class));