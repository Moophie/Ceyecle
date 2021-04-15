<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function getFriends()
    {
        // Get all friends of user and put it in an array
        $user = Auth::user();
        $data['friends'] = User::where()->all();
        return view('friends/list', $data);
    }

    public function search(Request $request)
    {
        $input = $request->username;
        $data['search'] = User::where('username', 'like', '%' . $input . '%')->get();
        return view('friends/search', $data);
    }
}
