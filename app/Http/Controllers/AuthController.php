<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

use function Laravel\Prompts\password;

class AuthController extends Controller
{
    public function login(Request $request) {
        // $request->validate([
        //     'email' => 'required||email',
        //     'password' => 'required'
        // ]);

        $credential = $request->only('email', 'password');

        if (!Auth::attempt($credential)) {
            return response()->json(['message' => 'Gagal Login'], 401);
        }
        
        if (!$token = JWTAuth::attempt($credential)) {
            return response()->json(['message' => 'Gagal Login'], 401);
        }

        // $user = Auth::user();
        return response()->json([
            'access_toke' => $token,
            'token_type' => 'bearer',
            'message' => 'Berhasil'
        ]);
    }

    
}
