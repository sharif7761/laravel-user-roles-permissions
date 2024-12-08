<?php

namespace App\Repositories\Contracts;

interface PermissionRepositoryInterface
{
    public function create(array $data);

    public function update(int $permissionId, array $data);

    public function delete(int $permissionId);
}
