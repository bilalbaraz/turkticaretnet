<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register()
    {
        return response()->json(['success' => true]);
    }

    public function login()
    {
        return response()->json(['success' => true]);
    }

    public function logout()
    {
        return response()->json(['success' => true]);
    }
}
