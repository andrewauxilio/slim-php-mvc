<?php

namespace app\controllers\api;

use app\DTOs\auth\LoginRequestDTO;
use app\services\DatabaseService;

class AuthController
{
    public function __construct(private readonly DatabaseService $databaseService)
    {
    }

    public function login(LoginRequestDTO $loginRequestDTO): array
    {
        dd($loginRequestDTO);
    }

    public function register(): array
    {
        return [];
    }
}