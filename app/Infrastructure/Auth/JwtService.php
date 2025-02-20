<?php
namespace App\Infrastructure\Auth;

use App\Domain\Entities\RefreshToken;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;
use Carbon\Carbon;

class JwtService
{
    public function generateTokens($user): array
    {
        $accessToken = JWTAuth::fromUser($user);

        $payload = JWTAuth::setToken($accessToken)->getPayload();
        $jti = $payload->get('jti');

        $refreshToken = Str::random(64);

        RefreshToken::create([
            'user_id' => $user->id,
            'token' => $refreshToken,
            'jti' => $jti,
            'expires_at' => Carbon::now()->addDays(30),
        ]);

        return [
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
        ];
    }

    public function refreshToken(string $token): array
    {
        $refreshToken = RefreshToken::where('token', $token)
            ->where('expires_at', '>', now())
            ->first();

        if (!$refreshToken) {
            throw new \Exception('Invalid or expired refresh token');
        }

        $refreshToken->delete();

        $user = $refreshToken->user;
        return $this->generateTokens($user);
    }

    public function deleteTokens()
    {
        $token = JWTAuth::getToken();

        if ($token) {
            $payload = JWTAuth::decode($token);
            $jti = $payload->get('jti');

            RefreshToken::where('jti', $jti)->delete();

            JWTAuth::invalidate($token);
        }
    }
}
