<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use App\Models\UsersFriendship;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller
{
    public function getFriends()
    {
        // Get all friends of user and put it in an array
        $user = Auth::user();
        $friends = UsersFriendship::where('status', '=', 'confirmed')
                                        ->where(function ($q) use ($user) {
                                            $q->where('user_id1', '=', $user->id)
                                            ->orWhere('user_id2', '=', $user->id);
                                        })->get();
        $data = [];
        foreach ($friends as $friend) {
            if ($friend->user_id1 == $user->id) {
                $user_id = $friend->user_id2;
            } else {
                $user_id = $friend->user_id1;
            }
            array_push($data, User::find($user_id));
        }
        return view('friends/list', ['friends'=>$data]);
    }

    public function search(Request $request)
    {
        $input = $request->username;
        $data['search'] = User::where([['username', 'like', $input . '%'], ['username', '!=', Auth::user()->username]])->get();
        return view('friends/search', $data);
    }

    public function addFriend($user)
    {
        $currentUser = Auth::user();
        $user = User::find($user);
        $user->friends()->attach($currentUser->id, ['status' => 'pending']);
        return view('friends/search');
    }
}
