<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public function riders()
    {
        return $this->hasMany(Rider::class);
    }

    public function races()
    {
        return $this->belongsToMany(Race::class, 'races_teams');
    }
}
