<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
}
