<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;

class RoomController extends Controller
{
    public function index()
    {
        $data['rooms'] = Room::all();
        return view('rooms/index', $data);
    }

    //
    public function createRoom(Request $request)
    {
        $room = new Room();
        $room->event_id = $request->input('event-id');
        $room->save();

        return redirect('rooms/index');
    }

    public function show($room)
    {
        $data['room'] = Room::where('id', $room)->with('users')->first();
        $data['participants'] = Room::with('users')->get();

        return view('rooms/show', $data);
    }

    public function invite(Request $request)
    {
        $data['room'] = Room::where('id', $request->input('room-id'))->first();

        return view('rooms/invite', $data);
    }

    public function inviteFriend(Request $request)
    {
        $room_id = $request->input('room-id');
        $room = Room::find($room_id);
        $room->users()->attach($request->input('friend-id'));

        return redirect()->route('show-room', ['room' => $room_id]);
    }
}
