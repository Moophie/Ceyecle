<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Chat;
use App\Models\User;
use App\Models\UsersFriendship;

class ChatController extends Controller
{
    public function index($friendId)
    {
        $user = Auth::user();
        $data['friendship'] = UsersFriendship::where('status', '=', 'confirmed')
        ->where(function ($q) use ($user, $friendId) {
            $q->where([['user_id1', '=', $user->id], ['user_id2', '=', $friendId]])
            ->orWhere([['user_id2', '=', $user->id], ['user_id1', '=', $friendId]]);
        })->first();
        $data['friend'] = User::where('id', '=', $friendId)->first();
        $data['chat'] = Chat::where('friendship_id', $data['friendship']['id'])->get();

        return view('friends/chat', $data);
    }

    public function sendMessage(Request $request)
    {
        $message = new Chat();
        $message->user_id = $request->input('user-id');
        $message->friendship_id = $request->input('friendship-id');
        $message->content = $request->input('message-content');
        $message->save();

        return redirect()->route('chat', ['friend' => $request->input('friend-id')]);
    }
}
