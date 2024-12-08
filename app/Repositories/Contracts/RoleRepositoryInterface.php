<?php

namespace App\Repositories\Contracts;

interface RoleRepositoryInterface
{
    public function getAllRoles();

    public function createRole(array $data);

    public function updateRole($id, array $data);

    public function deleteRole($id);

    public function assignPermissionsToRole($roleId, array $permissionIds);
}
