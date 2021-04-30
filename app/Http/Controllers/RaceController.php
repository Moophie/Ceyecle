<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Race;
use Illuminate\Support\Carbon;

class RaceController extends Controller
{
    public function upcomingRaces()
    {
        $upcoming_races = Race::where('startdate', '>=', Carbon::now('Europe/Brussels'))->orderBy('date', 'ASC')->limit(3)->get();
        return view('index', ['upcoming_races' => $upcoming_races]);
    }
}
