<?php

namespace App\Application\UseCases\User;

use App\Domain\Interfaces\Repositories\UserRepositoryInterface;

class RegisterUserUseCase
{
    public function __construct(
        private UserRepositoryInterface $repository
    ) {}

    public function execute(array $data)
    {
        return $this->repository->create($data);
    }
}
