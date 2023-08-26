<?php

namespace app\controllers\api;

use app\DTOs\auth\LoginRequestDTO;
use app\DTOs\auth\RegisterRequestDTO;
use app\exceptions\validation\ValidationException;
use app\services\auth\AuthService;
use app\validations\auth\LoginValidation;
use app\validations\auth\RegisterValidation;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\MessageInterface;

class AuthController
{
    public function __construct(private readonly AuthService $authService)
    {
    }

    public function login(Request $request, Response $response): MessageInterface
    {
        $response = $response->withHeader('Content-Type', 'application/json');

        try {
            $loginValidation = new LoginValidation($request);
            $loginValidation->validate();

            $loginDTO = new LoginRequestDTO($loginValidation->validate());

            $user = $this->authService->login($loginDTO);

            $response->getBody()->write(json_encode($user));

            return $response;
        } catch (ValidationException $exception) {
            $response->getBody()->write(json_encode(['error' => $exception->getErrors()]));

            return $response;
        }
    }

    public function register(Request $request, Response $response): MessageInterface
    {
        $response = $response->withHeader('Content-Type', 'application/json');

        try {
            $registerValidation = new RegisterValidation($request);
            $registerValidation->validate();

            $registerDTO = new RegisterRequestDTO($registerValidation->validate());

            $user = $this->authService->register($registerDTO);

            $response->getBody()->write(json_encode($user));

            return $response;
        } catch (ValidationException $exception) {
            $response->getBody()->write(json_encode(['error' => $exception->getErrors()]));

            return $response;
        }
    }
}