<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function cycleRoutes()
    {
        return $this->hasMany(CycleRoute::class, 'event_id', 'event_code');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
