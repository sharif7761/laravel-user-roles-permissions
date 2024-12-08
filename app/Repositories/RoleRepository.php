<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Contracts\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    public function getAllRoles()
    {
        return Role::with('permissions')->get();
    }

    public function createRole(array $data)
    {
        $role = Role::create([
            'name' => $data['name'],
        ]);

        if (isset($data['permissions'])) {
            $role->permissions()->sync($data['permissions']);
        }

        return $role;
    }

    public function updateRole($id, array $data)
    {
        $role = Role::findOrFail($id);
        $role->update([
            'name' => $data['name'],
        ]);

        if (isset($data['permissions'])) {
            $role->permissions()->sync($data['permissions']);
        }

        return $role;
    }

    public function deleteRole($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return $role;
    }

    public function assignPermissionsToRole($roleId, array $permissionIds)
    {
        $role = Role::findOrFail($roleId);
        $role->permissions()->sync($permissionIds);

        return $role;
    }
}
