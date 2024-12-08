<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function assignPermission(int $userId, array $permissions): array;

    public function getAllPermissions(int $userId): array;

    public function assignRolesToUser(int $userId, array $roles): array;
}
