<?php

namespace App\Http\ViewComposers;

use App\Models\User;
use App\Models\UsersFriendship;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;

class RequestComposer
{
    private $users;

    public function __construct(User $users)
    {
        $this->users = $users;
    }

    public function compose(View $view)
    {
        // Get all friend requests of user and put it in an array
        $user = Auth::user();
        $friends = UsersFriendship::where([['status', '=', 'pending'], ['user_id1', '=', $user->id]])->get();

        $data = [];
        foreach ($friends as $friend) {
            $user_id = $friend->user_id2;
            array_push($data, User::find($user_id));
        }
        
        $view->with('requests', $data);
    }
}
