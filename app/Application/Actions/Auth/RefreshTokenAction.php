<?php

namespace App\Application\Actions\Auth;

use App\Infrastructure\Auth\JwtService;

class RefreshTokenAction
{
    public function __construct(
        private JwtService $jwtService
    ) {}

    public function execute(array $data): array
    {
        return $this->jwtService->refreshToken($data['token']);
    }
}

