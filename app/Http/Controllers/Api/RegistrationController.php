<?php

namespace App\Http\Controllers\Api;

use App\Application\UseCases\User\RegisterUserUseCase;
use App\Http\Requests\RegistrationRequest;
use App\Http\Resources\UserResource;
use Illuminate\Routing\Controller;
use OpenApi\Attributes as OA;

class RegistrationController extends Controller
{
    #[OA\Post(
        path: '/api/registration',
        summary: 'Register a new user',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['email', 'password', 'gender'],
                properties: [
                    new OA\Property(property: 'email', type: 'string', format: 'email', example: 'asd@example.org'),
                    new OA\Property(property: 'password', type: 'string', example: '123456789'),
                    new OA\Property(property: 'gender', type: 'string', enum: ['male', 'female', 'other'], example: 'male')
                ]
            )
        ),
        tags: ['Auth'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'User successfully registered',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', properties: [
                            new OA\Property(property: 'id', type: 'integer', example: 2),
                            new OA\Property(property: 'email', type: 'string', example: 'asd@example.org'),
                            new OA\Property(property: 'gender', type: 'string', example: 'male'),
                            new OA\Property(property: 'created_at', type: 'string', format: 'date-time', example: '2025-02-20T06:10:40.000000Z')
                        ],
                            type: 'object'
                        )
                    ]
                )
            ),
            new OA\Response(response: 400, description: 'Invalid input')
        ]
    )]
    public function __invoke(
        RegistrationRequest $request,
        RegisterUserUseCase $useCase
    ): UserResource
    {
        $user = $useCase->execute($request->validated());
        return new UserResource($user);
    }
}
