<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\Contracts\AuthRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->authRepository->register($request->all());

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
        ], 201);
    }

    public function login(LoginRequest  $request)
    {
        $credentials = $request->only('email', 'password');
        $token = $this->authRepository->login($credentials);

        if (!$token) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
        ]);
    }

    public function logout()
    {
        $loggedOut = $this->authRepository->logout();

        if (!$loggedOut) {
            return response()->json(['error' => 'User not logged in'], 401);
        }

        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }

    public function profile()
    {
        $user = $this->authRepository->profile();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        return response()->json([
            'message' => 'Profile info',
            'user' => $user,
        ]);
    }
}
