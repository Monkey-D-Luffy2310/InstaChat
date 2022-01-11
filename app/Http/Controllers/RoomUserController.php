<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\User;
use App\Models\RoomUser;

class RoomUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRoomByUser($user_id)
    {
        $user = User::find($user_id);
        if ($user) {
            $rooms = $user->rooms;
            foreach($rooms as $room) {
                $room['messages'] = $room->messages;
            }
            return response()->json([
                'data' => $rooms,
                'success' => true,
            ]);
        }
        else return response()->json([
            'error' => 'Not found user id',
            'success' => false
        ]);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserByRoom($room_id)
    {
        $room = Room::find($room_id);
        if ($room) {
            $user = $room->users;
            return response()->json([
                'data' => $user,
                'success' => true,
            ]);
        }
        else return response()->json([
            'error' => 'Not found room id',
            'success' => false
        ]);
    }

    public function store(Request $request, $room_id) {
        $room = Room::find($room_id);
        if ($room) {
            $users = collect($request['users']);
            $room->users()->attach($users);

            return response()->json([
                'data' => $room,
                'success' => true
            ]);
        }
        else return response()->json([
            'error' => 'Not found room id',
            'success' => false
        ]);
    }
}
