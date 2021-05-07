<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;

    public function stages()
    {
        return $this->hasMany(Stage::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'races_teams');
    }
}
