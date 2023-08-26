<?php

namespace app\controllers;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\MessageInterface;

class BaseAPIController
{
    public function __construct()
    {
    }

    public function apiSuccess(Response $response, array $data): MessageInterface
    {
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode(["success" => $data]));

        return $response;
    }

    public function apiError(Response $response, string $message): MessageInterface
    {
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode(['error' => $message]));

        return $response;
    }
}