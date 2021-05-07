<?php

namespace App\Http\Controllers;

use App\Classes\ProCyclingStats;
use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Message;


class RoomController extends Controller
{
    public function index()
    {
        $data['rooms'] = Room::whereHas('users', function (Builder $query) {
            $query->where('user_id', '=', Auth::user()->id)->where('status', '=', 'active');
        })->get();

        $data['room_requests'] = Room::whereHas('users', function (Builder $query) {
            $query->where('user_id', '=', Auth::user()->id)->where('status', '=', 'pending');
        })->get();

        return view('rooms/index', $data);
    }

    public function createRoom(Request $request)
    {
        $race_id = $request->input('race-id');
        $existing_room = Room::whereHas('users', function (Builder $query) {
            $query->where('user_id', '=', Auth::user()->id);
        })->whereHas('users', function (Builder $query) use ($race_id) {
            $query->where('race_id', '=', $race_id);
        })
        ->get();

        if ($existing_room->isEmpty()) {
            $room = new Room();
            $room->race_id = $race_id;
            $room->save();

            $room = Room::find($room->id);
            $room->users()->attach(Auth::user()->id, ['status' => 'active']);
        }

        return redirect('rooms');
    }

    public function show($room)
    {
        $data['room'] = Room::where('id', $room)->with('users')->with('messages')->first();
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
        $room->users()->attach($request->input('friend-id'), ['status' => 'pending']);

        return redirect()->route('show-room', ['room' => $room_id]);
    }

    public function acceptRequest($room_id)
    {
        $room = Room::find($room_id);
        $room->users()->updateExistingPivot(Auth::user()->id, ['status' => 'active']);
        return redirect('rooms');
    }

    public function sendMessage(Request $request)
    {
        $message = new Message();
        $message->user_id = $request->input('user-id');
        $message->room_id = $request->input('room-id');
        $message->content = $request->input('message-content');
        $message->save();

        return redirect()->route('show-room', ['room' => $request->input('room-id')]);
    }
}
