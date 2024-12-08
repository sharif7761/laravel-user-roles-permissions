<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Repositories\Contracts\PermissionRepositoryInterface;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function create(array $data)
    {
        return Permission::create($data);
    }

    public function update(int $permissionId, array $data)
    {
        $permission = Permission::findOrFail($permissionId);
        $permission->update($data);

        return $permission;
    }

    public function delete(int $permissionId)
    {
        $permission = Permission::findOrFail($permissionId);
        return $permission->delete();
    }
}
