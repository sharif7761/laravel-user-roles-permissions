<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Repositories\Contracts\RoleRepositoryInterface;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        $roles = $this->roleRepository->getAllRoles();
        return response()->json(['roles' => $roles], 200);
    }

    public function store(RoleRequest $request)
    {
        $role = $this->roleRepository->createRole($request->all());

        return response()->json(['message' => 'Role created successfully', 'role' => $role], 201);
    }

    public function update(RoleRequest $request, $id)
    {
        $role = $this->roleRepository->updateRole($id, $request->all());

        return response()->json(['message' => 'Role updated successfully', 'role' => $role], 200);
    }

    public function destroy($id)
    {
        $this->roleRepository->deleteRole($id);

        return response()->json(['message' => 'Role deleted successfully'], 200);
    }

    public function assignPermissions(Request $request, $roleId)
    {
        $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = $this->roleRepository->assignPermissionsToRole($roleId, $request->permissions);

        return response()->json(['message' => 'Permissions assigned to role successfully', 'role' => $role], 200);
    }
}
