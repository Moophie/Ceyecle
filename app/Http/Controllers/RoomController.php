<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

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
}
