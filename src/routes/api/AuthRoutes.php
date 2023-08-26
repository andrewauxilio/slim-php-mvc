<?php
namespace App\Routers\Api;

global $app;
global $container;

use app\DTOs\auth\LoginRequestDTO;
use app\middlewares\AuthMiddleware;
use app\validations\auth\LoginValidation;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Slim\Routing\RouteCollectorProxy;

$app->group('/api', function (RouteCollectorProxy $group) use ($container) {
    $group->post('/auth/login', function (Request $request, Response $response, $args) use ($container) {
        //TODO - validation
        $loginValidation = new LoginValidation($request);
        $requestData = $loginValidation->validate();

        // Convert to DTO
        $loginDTO = new LoginRequestDTO($requestData);

        $authController = $container->get('authController');
        $data = $authController->login($loginDTO);

        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode($data));

        return $response;
    });

    $group->post('/auth/register', function (Request $request, Response $response, $args) use ($container) {
        //TODO - validation
        // Convert to DTO
        $loginDTO = new LoginRequestDTO($request);

        $authController = $container->get('authController');
        $data = $authController->login($loginDTO);

        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode($data));

        return $response;
    });
})->add(AuthMiddleware::class);