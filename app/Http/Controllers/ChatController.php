<?php

namespace App\Http\Controllers;

use App\Classes\HelperFunctions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Chat;
use App\Models\User;
use App\Models\UsersFriendship;

class ChatController extends Controller
{
    public function overview()
    {
        $userId = Auth::id();
        
        $data['friendships'] = UsersFriendship::where('status', '=', 'confirmed')
        ->where(function ($q) use ($userId) {
            $q->where('user_id1', '=', $userId)
            ->orWhere('user_id2', '=', $userId);
        })->get();

        $i = 0;
        foreach ($data['friendships'] as $friendship) {
            $data['friendships'][$i]['other_user'] = $friendship->other_user();
            $data['friendships'][$i]['latest_chat'] = $friendship->chats->last();
            $i++;
        }

        return view('friends/chatOverview', $data);
    }

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

        // updates the messages to be "read" when they're displayed on the user's page
        Chat::where([['friendship_id', '=', $data['friendship']['id']], ['status', '=', 'unread'],  ['user_id', '!=', $user->id]])->update(['status' => 'read']);

        return view('friends/chat', $data);
    }

    public function sendMessage(Request $request)
    {
        $message = new Chat();
        $message->user_id = $request->input('user-id');
        $message->friendship_id = $request->input('friendship-id');
        $message->content = $request->input('message-content');
        $message->save();

        $friendship = UsersFriendship::find($message->friendship_id);
        $other_user = $friendship->other_user();

        if ($other_user->device_key) {
            $registration_ids = array($other_user->device_key);
            HelperFunctions::sendNotification('New message', $message->content, $registration_ids);
        }
        
        return redirect()->route('chat', ['friend' => $request->input('friend-id')]);
    }
}
