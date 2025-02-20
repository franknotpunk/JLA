<?php

namespace App\Http\Controllers\Api;

use App\Application\Actions\Auth\LoginAction;
use App\Application\Actions\Auth\LogoutAction;
use App\Application\Actions\Auth\RefreshTokenAction;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RefreshRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    public function login(
        LoginRequest $request,
        LoginAction $loginAction
    ): JsonResponse {
        $tokens = $loginAction->execute($request->validated());
        return response()->json($tokens);
    }

    public function logout(
        LogoutAction $logoutAction
    ): JsonResponse {
        $logoutAction->execute();
        return response()->json();
    }

    public function refresh(
        RefreshRequest $request,
        RefreshTokenAction $refreshTokenAction
    ): JsonResponse {
        $newToken = $refreshTokenAction->execute($request->validated());
        return response()->json($newToken);
    }
}
