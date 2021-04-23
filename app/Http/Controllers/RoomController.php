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
        $data['room'] = Room::where('id', $room)->first();

        return view('rooms/show', $data);
    }

    public function invite(Request $request)
    {
        $data['room'] = Room::where('id', $request->input('room-id'))->first();
        $data['friends'] = User::all();

        return view('rooms/invite', $data);
    }

    public function inviteFriend(Request $request)
    {
        $room = Room::find($request->input('room-id'));
        $room->users()->attach($request->input('friend-id'));
        $data['room'] = Room::where('id', $request->input('room-id'))->first();
        
        return view('rooms/show', $data);
    }
}
