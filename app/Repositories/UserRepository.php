<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function assignPermission(int $userId, array $permissions): array
    {
        $user = User::findOrFail($userId);
        $user->permissions()->syncWithoutDetaching($permissions);

        return $user->load('permissions')->permissions->toArray();
    }

    public function getAllPermissions(int $userId): array
    {
        $user = User::findOrFail($userId);
        $rolePermissions = $user->roles()
            ->with('permissions')
            ->get()
            ->pluck('permissions')
            ->flatten()
            ->pluck('name')
            ->toArray();

        $directPermissions = $user->permissions->pluck('name')->toArray();

        return array_unique(array_merge($rolePermissions, $directPermissions));
    }

    public function assignRolesToUser(int $userId, array $roles): array
    {
        $user = User::findOrFail($userId);
        $user->roles()->syncWithoutDetaching($roles);

        return $user->load('roles')->roles->toArray();
    }
}
