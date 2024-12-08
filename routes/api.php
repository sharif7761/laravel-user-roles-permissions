<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth:api']], function() {
    Route::get('profile', [AuthController::class, 'profile']);
    Route::get('logout', [AuthController::class, 'logout']);

    Route::resource('roles', RoleController::class);
    Route::post('roles/{roleId}/permissions', [RoleController::class, 'assignPermissions']);

    // User Role Assignment
    Route::post('users/{userId}/roles', [UserController::class, 'assignRoles']);
    Route::get('users/{userId}/permissions', [UserController::class, 'getUserPermissions']);
    Route::post('users/{userId}/permission', [UserController::class, 'assignPermission']);

    // Permission Routes
    Route::resource('permissions', PermissionController::class);
});
