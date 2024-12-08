<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function assignRoles(Request $request, $userId)
    {
        $request->validate([
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $user = User::findOrFail($userId);
        $user->roles()->sync($request->roles);

        return response()->json(['message' => 'Roles assigned successfully', 'user' => $user->load('roles')]);
    }
}
