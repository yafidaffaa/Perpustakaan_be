<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnggotaAuthController extends Controller
{
    public function login(Request $r)
    {
        $c = $r->only('username', 'password');
        if (!$token = Auth::guard('anggota')->attempt([
            'username' => $c['username'],
            'password' => $c['password']
        ])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('anggota')->factory()->getTTL() * 60
        ];
    }

    public function me()
    {
        return Auth::guard('anggota')->user();
    }
    public function logout()
    {
        Auth::guard('anggota')->logout();
        return ['message' => 'Logged out'];
    }
}
