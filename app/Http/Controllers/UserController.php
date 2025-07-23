<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller as BaseController;

class UserController extends BaseController
{
    function index()
    {
        $users = User::with('roles')->get();
        return response()->json([
            'message' => 'You Have Access',
            'data' => $users
        ]);
    }

    function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6'
        ]);

        try {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ]);

            if (!$user) {
                return response()->json([
                    'message' => 'Create User Failed',
                    'user' => $user,
                    'sendder' => Auth::user()->name
                ], 401);
            }

            return response()->json([
                'message' => 'User Create Successfuly',
                'user' => $user,
                'sendder' => Auth::user()->name
            ], 201);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'Create User Failed ' + $error,
                'user' => $request,
                'sender' => Auth::user()->name
            ], 401);
        }
    }

    function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6'
        ]);

        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json([
                    'message' => 'Update User Failed, User Not Found',
                    'user' => $user,
                    'sendder' => Auth::user()->name
                ], 401);
            }

            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ]);

            return response()->json([
                'message' => 'User Update Successfuly',
                'user' => $user,
                'sendder' => Auth::user()->name
            ], 201);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'Create User Failed ' + $error,
                'user' => $request,
                'sender' => Auth::user()->name
            ], 401);
        }
    }

    function delete($id)
    {
        $user = User::find($id);

        try {
            if (!$user) {
                return response()->json([
                    'message' => 'Delete User Failed, User Not Found',
                    'user' => $user,
                    'sendder' => Auth::user()->name
                ], 401);
            }

            $user->delete();

            return response()->json([
                'message' => 'User Delete Successfuly',
                'user' => $user,
                'sendder' => Auth::user()->name
            ], 201);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'Create User Failed ' + $error,
                'sender' => Auth::user()->name
            ], 401);
        }
    }
}
