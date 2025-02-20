<?php

namespace App\Http\Controllers\Api;

use App\Application\UseCases\User\GetUserProfileUseCase;
use App\Http\Resources\UserResource;
use Illuminate\Routing\Controller;
use OpenApi\Attributes as OA;
class ProfileController extends Controller
{
    #[OA\Get(
        path: '/api/profile',
        summary: 'Get current user profile',
        security: [['bearerAuth' => []]],
        tags: ['Profile'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'User profile data',
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
            new OA\Response(response: 401, description: 'Unauthorized')
        ]
    )]
    public function show(
        GetUserProfileUseCase $useCase
    ): UserResource {
        $user = $useCase->execute();
        return new UserResource($user);
    }
}
