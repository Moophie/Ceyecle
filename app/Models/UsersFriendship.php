<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersFriendship extends Model
{
    use HasFactory;

    public function friendship()
    {
        return $this->hasMany(User::class, 'users_friendships', 'user_id1', 'user_id2');
    }
}
