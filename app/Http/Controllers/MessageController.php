<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\User;
use App\Models\Room;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
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
        $message = Message::create($requestData);
        $request->validate([
            'message' => 'required',
            'room_id' => 'required'
        ]);
        return response()->json([
            'data' => $message,
            'success' => true
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
        $message = Message::find($id);
        $message->update(['message' => $request['message']]);
        return response()->json([
            'data' => $message,
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json([
            'data' => Message::destroy($id),
            'success' => true
        ]);
    }

    public function getMessageByUser($user_id) {
        $message = DB::table('messages')->where('user_id', $user_id)->get();

        return response()->json([
            'data' => $message,
            'success' => true
        ]);
    }

    public function getMessageByRoom($room_id) {
        $message = DB::table('messages')->where('room_id', $room_id)->get();

        return response()->json([
            'data' => $message,
            'success' => true
        ]);
    }
}
