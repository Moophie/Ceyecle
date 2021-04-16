<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Carbon;

class EventController extends Controller
{
    public function upcomingEvents()
    {
        $upcoming_events = Event::where('date', '>=', Carbon::now('Europe/Brussels'))->orderBy('date', 'ASC')->limit(3)->get();
        return view('index', ['upcoming_events' => $upcoming_events]);
    }
}
