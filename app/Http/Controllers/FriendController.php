<?php

namespace App\Http\Controllers;

use App\Classes\HelperFunctions;
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

        if ($user->device_key) {
            $registration_ids = array($user->device_key);
            HelperFunctions::sendNotification('New friendrequest', "You have a friend request from ".$currentUser->username, $registration_ids);
        }

        return view('friends/search');
    }

    public function acceptRequest($user)
    {
        $currentUser = Auth::user();
        UsersFriendship::where([['status', '=', 'pending'], ['user_id2', '=', $user], ['user_id1', '=', $currentUser->id]])->update(['status' => 'confirmed']);

        return redirect('friends/list');
    }
}
