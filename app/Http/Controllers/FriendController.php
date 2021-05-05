<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UsersFriendship;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class FriendController extends Controller
{
    public function getFriend($userId)
    {
        $user = User::find($userId);
        return view('friends/profile', $user);
    }

    public function friendRequests()
    {
        // Get all friend requests of user and put it in an array
        $user = Auth::user();
        $friends = UsersFriendship::where([['status', '=', 'pending'], ['user_id1', '=', $user->id]])->get();

        $data = [];
        foreach ($friends as $friend) {
            $user_id = $friend->user_id2;
            array_push($data, User::find($user_id));
        }
        
        return view('friends/list', ['requests'=>$data]);
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

    public function acceptRequest($user)
    {
        $currentUser = Auth::user();
        UsersFriendship::where([['status', '=', 'pending'], ['user_id2', '=', $user], ['user_id1', '=', $currentUser->id]])->update(['status' => 'confirmed']);
        return redirect('friends/list');
    }
}
