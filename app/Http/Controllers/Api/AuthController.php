<?php

namespace App\Http\Controllers\Api;

use App\Application\Actions\Auth\LoginAction;
use App\Application\Actions\Auth\LogoutAction;
use App\Application\Actions\Auth\RefreshTokenAction;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RefreshRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use OpenApi\Attributes as OA;


#[OA\Info(
    version: '1.0.0',
    description: 'This is API documentation',
    title: 'My API',
    termsOfService: 'https://jla.loc',
)]
#[OA\SecurityScheme(
    securityScheme: 'bearerAuth',
    type: 'http',
    bearerFormat: 'JWT',
    scheme: 'bearer'
)]
class AuthController extends Controller
{
    #[OA\Post(
        path: '/api/login',
        summary: 'Login a user',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['email', 'password'],
                properties: [
                    new OA\Property(property: 'email', type: 'string', format: 'email', example: 'asd@example.org'),
                    new OA\Property(property: 'password', type: 'string', example: '123456789')
                ]
            )
        ),
        tags: ['Auth'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'User logged in',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'access_token', type: 'string', example: 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...'),
                        new OA\Property(property: 'refresh_token', type: 'string', example: 'sP0OseaUKOSb6qL6SJIvlHzlQK6t8vXPwc5ylzPg...')
                    ]
                )
            ),
            new OA\Response(response: 401, description: 'Unauthorized')
        ]
    )]
    public function login(
        LoginRequest $request,
        LoginAction  $loginAction
    ): JsonResponse
    {
        $tokens = $loginAction->execute($request->validated());
        return response()->json($tokens);
    }

    #[OA\Post(
        path: '/api/logout',
        summary: 'Logout a user',
        security: [['bearerAuth' => []]],
        tags: ['Auth'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Successfully logged out'
            ),
            new OA\Response(response: 401, description: 'Unauthorized')
        ]
    )]
    public function logout(
        LogoutAction $logoutAction
    ): JsonResponse
    {
        $logoutAction->execute();
        return response()->json();
    }

    #[OA\Post(
        path: '/api/refresh',
        summary: 'Refresh access token',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['token'],
                properties: [
                    new OA\Property(property: 'token', type: 'string', example: 'dE0Z9musQDoUMdf9eo1PlyfZghR1MLkjFLQUWeTuHQDYlcGCTpU5NAhoEGzByQMH')
                ]
            )
        ),
        tags: ['Auth'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'New access and refresh token',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'access_token', type: 'string', example: 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...'),
                        new OA\Property(property: 'refresh_token', type: 'string', example: '86EXLKPpnMZyNR4UXho9gbBscQeKIVymFmuLDj0UCfxyhisoYbdKt1aDIhfYCPGw')
                    ]
                )
            ),
            new OA\Response(response: 400, description: 'Invalid token')
        ]
    )]
    public function refresh(
        RefreshRequest     $request,
        RefreshTokenAction $refreshTokenAction
    ): JsonResponse
    {
        $newToken = $refreshTokenAction->execute($request->validated());
        return response()->json($newToken);
    }
}
