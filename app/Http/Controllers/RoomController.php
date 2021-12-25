<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Room;
use App\Http\Requests\RoomFormRequest;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'data' => Room::all(),
            'success' => true,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomFormRequest $request)
    {
        $room = Room::create([
            'name' => $request['name'],
            'description' => $request['description'],
        ]);
        $users = collect(request('users'));
        $users->push(auth()->user()->id);

        $room->users()->attach($users);

        return response()->json([
            'data' => $room,
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
        $room = Room::find($id);
        return response()->json([
            'data' => $room,
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
        $room = Room::find($id);
        $room->update($request->all());
        return response()->json([
            'data' => $room,
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
            'data' => Room::destroy($id),
            'success' => true
        ]);
    }
}
