<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LikedPost;
use Illuminate\Support\Facades\DB;
use App\Events\NewLike;
use App\Events\DisLike;
use App\Models\Post;
use App\User;

class LikedPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'data' => LikedPost::all(),
            'success' => true
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        $user_id = auth()->user()->id;
        $requestData['user_id'] = $user_id;
        $request->validate([
            'post_id' => 'required'
        ]);

        $like = LikedPost::create($requestData);
        $like['user'] = auth()->user();
        broadcast(new NewLike($like))->toOthers();
        return response()->json([
            'data' => $like,
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $liked_post = LikedPost::find($id);
        if ($liked_post) return $liked_post;
        return "Not found";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $liked_post = LikedPost::find($id);
        if ($liked_post) {
            broadcast(new DisLike($liked_post->get()))->toOthers();
            $liked_post->delete();
        }
        else return response()->json([
            'data' => "Not exist like post",
            'success' => false,
        ]);
        return response()->json([
            'success' => true,
        ]);
    }

    public function liked_user($user_id)
    {
        $liked_post = LikedPost::with(['user', 'post'])->where('user_id', $user_id)->get();

        return response()->json([
            'data' => $liked_post,
            'success' => true,
        ]);
    }

    public function liked_post($post_id)
    {
        $liked_post = LikedPost::with(['user', 'post'])->where('post_id', $post_id)->get();

        return response()->json([
            'data' => $liked_post,
            'success' => true,
        ]);
    }
}
