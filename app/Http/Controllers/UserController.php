<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function assignPermission(Request $request, $userId)
    {
        $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $permissions = $this->userRepository->assignPermission($userId, $request->permissions);

        return response()->json(['message' => 'Permissions assigned successfully', 'permissions' => $permissions]);
    }

    public function getUserPermissions($userId)
    {
        $permissions = $this->userRepository->getAllPermissions($userId);

        return response()->json(['permissions' => $permissions]);
    }

    public function assignRoles(Request $request, $userId)
    {
        $request->validate([
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $user = $this->userRepository->assignRolesToUser($userId, $request->roles);

        return response()->json([
            'message' => 'Roles assigned to user successfully',
            'user' => $user,
        ], 200);
    }
}
