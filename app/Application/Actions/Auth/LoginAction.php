<?php

namespace App\Application\Actions\Auth;

use App\Domain\Interfaces\Repositories\UserRepositoryInterface;
use App\Infrastructure\Auth\JwtService;
use Exception;

class LoginAction
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private JwtService $jwtService
    ) {}

    public function execute(array $credentials): array
    {
        $user = $this->userRepository->findByEmail($credentials['email']);

        if (!$user || !password_verify($credentials['password'], $user->password)) {
            throw new Exception('Invalid credentials');
        }

        return $this->jwtService->generateTokens($user);
    }
}

