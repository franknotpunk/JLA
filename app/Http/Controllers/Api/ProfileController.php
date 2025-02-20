<?php

namespace App\Http\Controllers\Api;

use App\Application\UseCases\User\GetUserProfileUseCase;
use App\Http\Resources\UserResource;
use Illuminate\Routing\Controller;

class ProfileController extends Controller
{
    public function show(
        GetUserProfileUseCase $useCase
    ): UserResource {
        $user = $useCase->execute();
        return new UserResource($user);
    }
}
