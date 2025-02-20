<?php

namespace App\Http\Controllers\Api;

use App\Application\UseCases\User\RegisterUserUseCase;
use App\Http\Requests\RegistrationRequest;
use App\Http\Resources\UserResource;
use Illuminate\Routing\Controller;

class RegistrationController extends Controller
{
    public function __invoke(
        RegistrationRequest $request,
        RegisterUserUseCase $useCase
    ): UserResource
    {
        $user = $useCase->execute($request->validated());
        return new UserResource($user);
    }
}
