<?php

namespace app\middlewares;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class AuthMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandler $handler): Response
    {
        // Your authentication logic here
        $session = $request->getHeaderLine('Authorization');

        $authenticated = true;

        // Validate the token, check permissions, etc.
        if ($authenticated) {
            return $handler->handle($request);
        } else {
            $responseBody = ['message' => 'Unauthorized'];
            $response = new Response(401, [], json_encode($responseBody));

            return $response->withHeader('Content-Type', 'application/json');
        }
    }
}