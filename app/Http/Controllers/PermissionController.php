<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\PermissionRepositoryInterface;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required|string|unique:permissions']);
        $permission = $this->permissionRepository->create($data);

        return response()->json(['message' => 'Permission created successfully', 'permission' => $permission]);
    }

    public function update(Request $request, $permissionId)
    {
        $data = $request->validate(['name' => 'required|string|unique:permissions,name,' . $permissionId]);
        $permission = $this->permissionRepository->update($permissionId, $data);

        return response()->json(['message' => 'Permission updated successfully', 'permission' => $permission]);
    }

    public function destroy($permissionId)
    {
        $this->permissionRepository->delete($permissionId);

        return response()->json(['message' => 'Permission deleted successfully']);
    }
}
