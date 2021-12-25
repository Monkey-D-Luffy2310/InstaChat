<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LikedPost;
use Illuminate\Support\Facades\DB;

class LikedPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LikedPost::all();
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

        return LikedPost::create($requestData);
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
        if ($liked_post) return $liked_post->post;
        return "Not found";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_id)
    {
        $user_id = auth()->user()->id;
        $liked_post = DB::table('liked_posts')->where([
            ['user_id', $user_id],
            ['post_id', $post_id],
        ])->delete();
        return response()->json([
            'data' => $liked_post,
            'success' => true,
        ]);
    }

    public function liked_user($user_id)
    {
        $liked_post = DB::table('liked_posts')->where('user_id', $user_id)->get();
        return response()->json([
            'data' => $liked_post,
            'success' => true,
        ]);
    }

    public function liked_post($post_id)
    {
        $liked_post = DB::table('liked_posts')->where('post_id', $post_id)->get();
        return response()->json([
            'data' => $liked_post,
            'success' => true,
        ]);
    }
}
