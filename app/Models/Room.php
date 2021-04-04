<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_rooms');
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
