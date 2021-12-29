<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'data' => Comment::all(),
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
            'comment' => 'required',
            'post_id' => 'required',
        ]);

        return Comment::create($requestData);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'data' => Comment::find($id),
            'success' => true,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_id = auth()->user()->id;
        $comment = Comment::find($id);
        if ($comment) {
            if ($comment->user->id != $user_id) {
                return response()->json([
                    'message' => 'Comment not belong to user',
                    'success' => false,
                ]);
            }

            $request->validate([
                'comment' => 'required',
            ]);
            $comment->update($request->all());

            return response()->json([
                'data' => $comment,
                'success' => true
            ]);
        }
        else {
            return response()->json([
                'success' => false,
                'message' => 'Not found comment id'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $user_id = auth()->user()->id;
        $comment = Comment::find($id);
        if ($comment->user->id != $user_id) {
            return response()->json([
                'message' => 'Comment not belong to user',
                'success' => false,
            ]);
        }

        $comment = Comment::destroy($id);
        return response()->json([
            'data' => $comment,
            'success' => true
        ]);
    }

    public function getCommentByUser($user_id) {
        $comments = Comment::with(['user', 'post'])->where('user_id', $user_id)->get();
        
        return response()->json([
            'data' => $comments,
            'success' => true,
        ]);
    }

    public function getCommentByPost($post_id) {
        $comments = Comment::with(['user', 'post'])->where('post_id', $post_id)->get();

        return response()->json([
            'data' => $comments,
            'success' => true,
        ]);
    }
}
