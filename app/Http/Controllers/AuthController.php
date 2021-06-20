<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request )
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myhardtoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return Response($response, 201);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();
        return Response(['message' => 'Logged out']);
    }
}
