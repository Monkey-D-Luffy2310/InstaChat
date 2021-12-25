<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//comment post api
Route::get('/comments', 'CommentController@index');
Route::get('/comments/{id}', 'CommentController@show');
Route::get('/comments/user/{user_id}', 'CommentController@get_comment_by_user');
Route::get('/comments/post/{post_id}', 'CommentController@get_comment_by_post');

//room api
Route::get('/rooms', 'RoomController@index');
Route::get('/rooms/{id}', 'RoomController@show');

//room user api
Route::get('/room_user/user/{user_id}', 'RoomUserController@getRoomByUser');
Route::get('/room_user/room/{room_id}', 'RoomUserController@getUserByRoom');

//message api
Route::get('/messages/user/{user_id}', 'MessageController@getMessageByUser');
Route::get('/messages/room/{room_id}', 'MessageController@getMessageByRoom');

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

    //comment post api
    Route::post('/comments', 'CommentController@store');
    Route::put('/comments/{id}', 'CommentController@update');
    Route::delete('/comments/{id}', 'CommentController@destroy');

    //room api
    Route::post('/rooms', 'RoomController@store');
    Route::put('/rooms/{id}', 'RoomController@update');
    Route::delete('/rooms/{id}', 'RoomController@destroy');

    //room user api
    Route::post('/room_user/{room_id}', 'RoomUserController@store');

    //message api
    Route::post('/messages', 'MessageController@store');
    Route::put('/messages/{id}', 'MessageController@update');
    Route::delete('/messages/{id}', 'MessageController@destroy');
});