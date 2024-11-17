<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $this->authService->signUp($data);
        $token = auth('api')->attempt(['email' => $data['email'], 'password' => $data['password']]);

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $this->authService->getUserByEmailAndPassword($data);
        $token = auth('api')->attempt(['email' => $data['email'], 'password' => $data['password']]);

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function logout()
    {
        auth('api')->invalidate(true);
        auth('api')->logout();

        return response()->json(['success' => true]);
    }
}
