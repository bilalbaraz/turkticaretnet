<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

        if (!$token = auth()->attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['success' => true, 'token' => $token]);
    }

    public function login()
    {
        return response()->json(['success' => true]);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['success' => true]);
    }
}
