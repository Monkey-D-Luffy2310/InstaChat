<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' =>  User::all(),
            'success' => true,
        ]);
    }

    public function show($id)
    {
        return response()->json([
            'data' => User::find($id),
            'success' => true,
        ]);
    }

    public function reset_password(Request $request) 
    {
        $user = User::where('username', $request['username'])->first();
        if (!$user || !Hash::check($request['oldPassword'], $user->password)) {
            return response()->json([
                'error' => 'The provided credentials are incorrect.',
                'success' => false
            ]);
        }

        $user->update([
            'password' => bcrypt($request['newPassword'])
        ]);

        return response()->json([
            'data' => $user,
            'success' => true
        ], 201);
    }

    public function update(Request $request, $id) {
        $user = User::find($id);
        $user->update($request->all());
        return response()->json([
            'data' => $user,
            'success' => true,
        ]);
    }
}
