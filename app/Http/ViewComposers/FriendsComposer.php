<?php

namespace App\Http\ViewComposers;

use App\Models\User;
use App\Models\UsersFriendship;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;

class FriendsComposer
{
    private $users;

    public function __construct(User $users)
    {
        $this->users = $users;
    }

    public function compose(View $view)
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
        
        $view->with('friends', $data);
    }
}
