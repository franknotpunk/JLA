<?php

namespace App\Application\Actions\Auth;

use App\Domain\Entities\RefreshToken;
use App\Infrastructure\Auth\JwtService;
use Tymon\JWTAuth\Facades\JWTAuth;

class LogoutAction
{
    public function __construct(
        private JwtService $jwtService
    ) {}

    public function execute(): void
    {
        $this->jwtService->deleteTokens();
    }
}

