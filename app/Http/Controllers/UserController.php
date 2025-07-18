<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Lumen\Routing\Controller as BaseController;

class UserController extends BaseController
{
    function index() {
        $users = User::with('roles')->get();
        return response()->json([
            'message' => 'You Have Access',
            'data' => $users
        ]);
    }
}
