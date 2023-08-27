<?php

namespace app\controllers\api;

use app\controllers\BaseAPIController;
use app\DTOs\auth\LoginRequestDTO;
use app\DTOs\auth\RegisterRequestDTO;
use app\helpers\AuthHelper;
use app\services\auth\AuthService;
use app\validations\auth\LoginValidation;
use app\validations\auth\RegisterValidation;
use Exception;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\MessageInterface;

class AuthController extends BaseAPIController
{
    public function __construct(private readonly AuthService $authService)
    {
        parent::__construct();
    }

    public function login(Request $request, Response $response, array $args): MessageInterface
    {
        try {
            $loginValidation = new LoginValidation($request);;

            $loginDTO = new LoginRequestDTO($loginValidation->validate());

            return $this->apiSuccess($response, $this->authService->login($loginDTO));
        } catch (Exception $exception) {
            return $this->apiError($response, $exception->getMessage());
        }
    }

    public function register(Request $request, Response $response, array $args): MessageInterface
    {
        try {
            $registerValidation = new RegisterValidation($request);

            $registerDTO = new RegisterRequestDTO($registerValidation->validate());

            $this->authService->register($registerDTO);

            return $this->apiSuccess($response, ['User registered successfully']);
        } catch (Exception $exception) {
            return $this->apiError($response, $exception->getMessage());
        }
    }

    public function logout(Request $request, Response $response, array $args): MessageInterface
    {
        try {
            $sessionId = AuthHelper::extractSessionFromRequest($request);

            if (!$sessionId) {
                return $this->apiSuccess($response, ['User logged out']);
            }

            $this->authService->logout($sessionId);

            return $this->apiSuccess($response, ['User logged out']);
        } catch (Exception $exception) {
            return $this->apiError($response, $exception->getMessage());
        }
    }
}