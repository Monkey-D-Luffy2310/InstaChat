<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\User;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'username' => $fields['username'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;
        $respone = [
            'user' => $user,
            'token' => $token
        ];

        return response($respone, 201);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $fields['username'])->first();
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;
        $respone = [
            'user' => $user,
            'token' => $token
        ];

        return response($respone, 201);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
