<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Race;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class RaceController extends Controller
{
    public function indexRaces()
    {
        $data['upcoming_races'] = Race::where('startdate', '>=', Carbon::now('Europe/Brussels'))->orderBy('startdate', 'ASC')->limit(3)->get();
        $data['ongoing_races'] = Race::where('startdate', '<=', Carbon::now('Europe/Brussels'))->where('enddate', '>=', Carbon::now('Europe/Brussels'))->orderBy('startdate', 'ASC')->get();
        $data['device_key'] = Auth::user()->device_key;
        
        return view('index', $data);
    }

    public function showRace($race)
    {
        $data['race'] = Race::where('id', $race)->with('stages')->first();

        return view('race/details', $data);
    }
}
