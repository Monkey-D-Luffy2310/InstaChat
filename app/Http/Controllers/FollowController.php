<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;

class FollowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'followed_user_id' => 'required'
        ]);

        $followed = Follow::create($requestData);
        return response()->json([
            'data' => $followed,
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($followed_user_id)
    {
        $user_id = auth()->user()->id;
        $followed = Follow::where([
            ['user_id', $user_id],
            ['followed_user_id', $followed_user_id],
        ]);

        if ($followed->first()) {
            $followed->delete();
        }
        else return response()->json([
            'data' => "You not followed",
            'success' => false,
        ]);
      
        return response()->json([
            'success' => true
        ]);
    }

    public function getFollowedUser($user_id) {
        $follow_users = Follow::with('followed_user')->where('user_id', $user_id)->get('followed_user_id');

        $data = [];
        foreach ($follow_users as $follow_user) {
            array_push($data, $follow_user['followed_user']);
        }
        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }

    public function getFollowed($followed_user_id) {
        $follow_users = Follow::with('user')->where('followed_user_id', $followed_user_id)->get();

        $data = [];
        foreach ($follow_users as $follow_user) {
            array_push($data, $follow_user['user']);
        }
        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }
}
