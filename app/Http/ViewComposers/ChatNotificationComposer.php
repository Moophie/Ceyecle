<?php

namespace App\Http\ViewComposers;

use App\Models\User;
use App\Models\Chat;
use App\Models\UsersFriendship;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;

class ChatNotificationComposer
{
    private $users;

    public function __construct(User $users)
    {
        $this->users = $users;
    }

    public function compose(View $view)
    {
        $userId = Auth::id();
        $friendships = UsersFriendship::where('status', '=', 'confirmed')
        ->where(function ($q) use ($userId) {
            $q->where('user_id1', '=', $userId)
            ->orWhere('user_id2', '=', $userId);
        })->get();

        $i = 0;
        foreach ($friendships as $friendship) {
            $unreadChats[$i] = $friendship->chats()->where([['status', '=', 'unread'], ['user_id', '!=', $userId]])->get();
            $i++;
        }

        $view->with('chats', $unreadChats);
    }
}
