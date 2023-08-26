<?php

namespace app\DTOs\auth;

use GuzzleHttp\Psr7\Request;

class LoginRequestDTO
{
    public function __construct(private readonly array $data)
    {
    }

    public function email(): string
    {
        return $this->data['email'];
    }

    public function password(): string
    {
        return $this->data['password'];
    }
}