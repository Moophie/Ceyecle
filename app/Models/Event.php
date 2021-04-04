<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function cycleRoutes()
    {
        return $this->hasMany(CycleRoute::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
