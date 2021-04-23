<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoomController extends Controller
{
    //
    public function createRoom(){

        return view('rooms/index');
    }

    public function show(){

        return view('rooms/show');
    }
}
