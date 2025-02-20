<?php

namespace App\Application\UseCases\User;

use App\Domain\Entities\User;
use App\Domain\Interfaces\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class GetUserProfileUseCase
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    public function execute(): User
    {
        return $this->userRepository->findByEmail(Auth::user()->email);
    }
}
