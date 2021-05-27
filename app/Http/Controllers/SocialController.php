<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SocialController extends Controller
{
    //

    public function social()
    {
        return view('social/index');
    }

    public function leaderboard()
    {
        return view('friends/leaderboards');
    }
}
