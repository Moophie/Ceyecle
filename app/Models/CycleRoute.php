<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CycleRoute extends Model
{
    use HasFactory;

    public function competitors()
    {
        return $this->belongsToMany(Competitor::class, 'competitors_races', 'competitor_id', 'race_id');
    }

}
