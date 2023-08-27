<?php

namespace app\helpers;

use GuzzleHttp\Psr7\Request;

class AuthHelper
{
    public static function extractSessionFromRequest(Request $request): ?string
    {
        $cookieHeader = $request->getHeaderLine('Cookie');

        $pattern = '/SESSION=([^;]+)/'; // Matches anything after "SESSION=" until the next semicolon
        preg_match($pattern, $cookieHeader, $matches);

        if (isset($matches[1])) {
            $sessionId = $matches[1];
            return $sessionId;
        }

        return null; // If SESSION cookie is not found
    }
}