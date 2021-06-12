<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UsersFriendship extends Model
{
    use HasFactory;

    public function friendship()
    {
        return $this->hasMany(User::class, 'users_friendships', 'user_id1', 'user_id2');
    }

    public function other_user(){
        if ($this->user_id1 == Auth::id()) {
            $other_user = User::find($this->user_id2);
        }

        if ($this->user_id2 == Auth::id()) {
            $other_user = User::find($this->user_id1);
        }

        return $other_user;
    }

    public function chats(){
        return $this->hasMany(Chat::class, 'friendship_id');
    }
}
