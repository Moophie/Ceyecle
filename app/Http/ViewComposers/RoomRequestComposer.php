<?php

namespace App\Http\ViewComposers;

use App\Models\User;
use App\Models\UsersRooms;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;

class RoomRequestComposer
{
    private $users;

    public function __construct(User $users)
    {
        $this->users = $users;
    }

    public function compose(View $view)
    {
        // Get all room requests of user and put it in an array
        $user = Auth::user();
        $rooms = UsersRooms::where([['status', '=', 'pending'], ['user_id', '=', $user->id]])->get();
        
        $view->with('rooms', $rooms);
    }
}
