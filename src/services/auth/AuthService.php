<?php

namespace app\services\auth;

use app\DTOs\auth\LoginRequestDTO;
use app\DTOs\auth\RegisterRequestDTO;
use app\services\DatabaseService;

class AuthService
{
    public function __construct(DatabaseService $databaseService)
    {
    }

    public function login(LoginRequestDTO $loginRequestDTO): array
    {
        return [];
    }

    public function register(RegisterRequestDTO $registerRequestDTO): array
    {
        return [];
    }
}