<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikedPostController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//authen api
Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');

//user api
Route::get('/users/{id}', 'UserController@show');

//post api
Route::get('/posts', 'PostController@index');
Route::get('/posts/{id}', 'PostController@show');

//like post api
Route::get('/liked_post', "LikedPostController@index");
Route::get('/liked_post/{id}', "LikedPostController@show");
Route::get('/liked_post/user/{id}', "LikedPostController@liked_user");
Route::get('/liked_post/post/{id}', "LikedPostController@liked_post");

Route::group(['middleware' => ['auth:sanctum']], function () {
    //user api
    Route::get('/users', 'UserController@index');

    Route::post('/logout', 'AuthController@logout');

    //post api
    Route::post('/posts', 'PostController@store');
    Route::put('/posts/{id}', 'PostController@update');
    Route::delete('/posts/{id}', 'PostController@destroy');

    //like post api
    Route::post('/liked_post', "LikedPostController@store");
    Route::delete('/liked_post/{post_id}', "LikedPostController@destroy");
});