<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    //@return \Illuminate\Http\JsonResponse
    public function login()
    {
        $credentials = request(['email', 'password']);
        if (! $token = auth::guard()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json([
            'message' => 'Login successful',
            'access_token' => $token,
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged successful']);
    }
}
