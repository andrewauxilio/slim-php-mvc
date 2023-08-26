<?php

namespace app\DTOs\auth;

class RegisterRequestDTO
{
    public function __construct(private readonly array $data)
    {
    }

    public function firstName(): string
    {
        return $this->data['firstName'];
    }

    public function lastName(): string
    {
        return $this->data['lastName'];
    }

    public function birthDate(): string
    {
        return $this->data['birthDate'];
    }

    public function bio(): string
    {
        return $this->data['bio'];
    }

    public function email(): string
    {
        return $this->data['email'];
    }

    public function password(): string
    {
        return $this->data['password'];
    }

    public function passwordConfirmation(): string
    {
        return $this->data['passwordConfirmation'];
    }
}