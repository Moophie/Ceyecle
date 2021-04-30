<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competitor extends Model
{
    use HasFactory;

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function cycleRoutes()
    {
        return $this->belongsToMany(CycleRoute::class, 'competitors_races', 'race_id', 'competitor_id');
    }

}
