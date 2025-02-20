<?php

namespace App\Domain\Interfaces\Repositories;

use App\Domain\DTOs\UserDTO;
use App\Domain\Entities\User;

interface UserRepositoryInterface
{
    public function create(array $data): User;
    public function findByEmail(string $email): ?User;
}
