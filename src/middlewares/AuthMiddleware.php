<?php

namespace app\middlewares;

use app\services\DatabaseService;
use DateTime;
use Doctrine\DBAL\Exception;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class AuthMiddleware implements MiddlewareInterface
{
    public function __construct(private readonly DatabaseService $databaseService)
    {
    }

    /**
     * @throws Exception
     * @throws \Exception
     */
    public function process(ServerRequestInterface $request, RequestHandler $handler): Response
    {
        // Your authentication logic here
        $cookieParams = $request->getCookieParams();
        $session = $cookieParams['SESSION'];

        $dbSession = $this->databaseService
            ->getConnection()
            ->fetchAssociative("SELECT * FROM user_sessions WHERE session_id = ?", [$session]);

        if (!$dbSession) {
            return $this->unauthorized();
        }

        if (new DateTime($dbSession['expiry_at']) < new DateTime()) {
            return $this->unauthorized('Session expired, please log in again');
        }

        return $handler->handle($request);

    }

    private function unauthorized(string $message = 'Unauthorized'): MessageInterface
    {
        $responseBody = ['message' => $message];
        $response = new Response(401, [], json_encode($responseBody));
        $response->withHeader('Content-Type', 'application/json');

        return $response;
    }
}