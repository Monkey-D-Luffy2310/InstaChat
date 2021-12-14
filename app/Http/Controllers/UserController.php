<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' =>  User::all()
        ]);
    }

    public function show($id)
    {
        return response()->json([
            'success' => true,
            'data' => User::find($id)
        ]);
    }
}
