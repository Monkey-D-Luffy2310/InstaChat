<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\AuthFormRequest;
use App\User;
use App\Events\MessageNotification;

class AuthController extends Controller
{
    public function register(AuthFormRequest $request) {
        $user = User::create([
            'username' => $request['username'],
            'password' => bcrypt($request['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;
        $respone = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json([
            'data' => $respone,
            'success' => true
        ], 201);
    }

    public function login(AuthFormRequest $request) {
        $user = User::where('username', $request['username'])->first();
        if (!$user || !Hash::check($request['password'], $user->password)) {
            return response()->json([
                'username' => 'The provided credentials are incorrect.',
                'success' => false
            ]);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;
        $respone = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json([
            'data' => $respone,
            'success' => true
        ], 201);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out',
            'success' => true
        ]);
    }
}
