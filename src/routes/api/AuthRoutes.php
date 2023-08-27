<?php
namespace App\Routers\Api;

global $app;
global $container;

use app\controllers\api\AuthController;
use Slim\Routing\RouteCollectorProxy;

$app->group('/api', function (RouteCollectorProxy $group) use ($container) {
    $authController = $container->get(AuthController::class);

    $group->post('/auth/login', [$authController, 'login']);
    $group->post('/auth/register', [$authController, 'register']);
    $group->post('/auth/logout', [$authController, 'logout']);
});
