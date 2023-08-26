<?php

namespace app\services\auth;

use app\DTOs\auth\LoginRequestDTO;
use app\DTOs\auth\RegisterRequestDTO;
use app\exceptions\auth\AuthException;
use app\services\DatabaseService;
use DateTime;
use Exception;

class AuthService
{
    public function __construct(private readonly DatabaseService $databaseService)
    {
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     * @throws AuthException
     */
    public function login(LoginRequestDTO $loginRequestDTO): array
    {
        $user = $this->databaseService
            ->getConnection()
            ->fetchAssociative("SELECT * FROM users WHERE email = ?", [$loginRequestDTO->email()]);

        if (!$user) {
            throw new AuthException('Invalid credentials');
        }

        if (!password_verify($loginRequestDTO->password(), $user['password'])) {
            throw new AuthException('Invalid credentials');
        }

        // invalidate previous session
        $this->databaseService
            ->getConnection()
            ->update(
                'user_sessions',
                ['is_valid' => 0],
                ['user_id' => $user['id']]
            );

        // create new session
        $sessionId = uniqid();
        $sessionExpiry = time() + 86400;

        setcookie('SESSION', $sessionId, $sessionExpiry , '/');

        $sessionData = [
            'userId' => $user['id'],
            'sessionId' => $sessionId,
            'expiry' => $sessionExpiry
        ];

        $this->databaseService
            ->getConnection()
            ->insert('user_sessions', [
                'session_id' => $sessionId,
                'user_id' => $user['id'],
                'data' => json_encode($sessionData),
                'expiry_at' => date('Y-m-d H:i:s', $sessionExpiry),
            ]);

        return [
            "firstName" => $user["first_name"],
            "lastName" => $user["last_name"],
            "email" => $user["email"],
        ];

    }

    /**
     * @throws \Doctrine\DBAL\Exception
     * @throws AuthException
     * @throws Exception
     */
    public function register(RegisterRequestDTO $registerRequestDTO): void
    {
        $user = $this->databaseService
            ->getConnection()
            ->fetchAssociative("SELECT * FROM users WHERE email = ?", [$registerRequestDTO->email()]);

        if ($user) {
            throw new AuthException('User already exists');
        }

        if ($registerRequestDTO->password() !== $registerRequestDTO->passwordConfirmation()) {
            throw new AuthException('Password and password confirmation do not match');
        }

        $password = password_hash($registerRequestDTO->password(), PASSWORD_DEFAULT);
        $email = $registerRequestDTO->email();
        $firstName = $registerRequestDTO->firstName();
        $lastName = $registerRequestDTO->lastName();
        $bio = $registerRequestDTO->bio();
        $birthDate = (new DateTime($registerRequestDTO->birthDate()))->format('Y-m-d');

        $this->databaseService
            ->getConnection()
            ->insert('users', [
                'email' => $email,
                'password' => $password,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'bio' => $bio,
                'role' => 'ADMIN',
                'birth_date' => $birthDate,
                'created_at' => (new DateTime())->format('Y-m-d H:i:s'),
                'updated_at' => (new DateTime())->format('Y-m-d H:i:s')
            ]);
    }
}