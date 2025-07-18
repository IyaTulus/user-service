<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

use function Laravel\Prompts\password;

class AuthController extends Controller
{

    public function index()
    {
        return response()->json(auth()->user());
    }

    public function register(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6'
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        if (!$user) {
            return response()->json([
                'message' => 'User Registered Failed',
                'user' => $user
            ], 401);
        }

        return response()->json([
            'message' => 'User Registered Successfuly',
            'user' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $credential = $request->only('email', 'password');

        if (!Auth::attempt($credential)) {
            return response()->json(['message' => 'Gagal Login'], 401);
        }

        try {
            if (! $token = JWTAuth::attempt($credential)) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['message' => 'Could not create token'], 500);
        }

        // $user = Auth::user();
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'message' => 'Berhasil'
        ]);
    }
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
