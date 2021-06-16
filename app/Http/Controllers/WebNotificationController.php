<?php

namespace App\Http\Controllers;

use App\Classes\HelperFunctions;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebNotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('test-notification');
    }
  
    public function storeToken(Request $request)
    {
        User::find(Auth::id())->update(['device_key'=>$request->token]);
        return response()->json(['Token successfully stored.']);
    }
  
    public function sendWebNotification(Request $request)
    {
        $registration_ids = User::whereNotNull('device_key')->pluck('device_key')->all();
        HelperFunctions::sendNotification($request->title, $request->body, $registration_ids);
    }
}
