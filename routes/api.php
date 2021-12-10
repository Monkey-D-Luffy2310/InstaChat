<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//authen route
Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');

//post route
Route::get('/posts', 'PostController@index');
Route::get('/posts/{id}', 'PostController@show');

Route::group(['middleware' => ['auth:sanctum']], function () {
    //user route
    Route::get('/users', 'UserController@index');

    Route::post('/logout', 'AuthController@logout');

    //post route
    Route::post('/posts', 'PostController@store');
    Route::put('/posts/{id}', 'PostController@update');
    Route::delete('/posts/{id}', 'PostController@destroy');
});

// Route::resource('posts', 'PostController');
