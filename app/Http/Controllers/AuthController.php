<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'role'     => 'required|in:admin,pustakawan,anggota'
        ]);

        $credentials = $request->only('username', 'password');

        // Tentukan guard berdasarkan role
        $guard = $request->role;

        if (!$token = Auth::guard($guard)->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'role'         => $guard,
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => JWTAuth::factory()->getTTL() * 60
        ]);
    }

    public function logout(Request $request)
    {
        $role = $request->get('role', 'admin'); // default guard kalau tidak dikirim

        Auth::guard($role)->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
