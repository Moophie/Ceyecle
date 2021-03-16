<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function signup()
    {
        return view('signup');
    }

    public function handleSignup(Request $request)
    {
        $user = new User();

        // Check if email is unique
        $email = $user::where('email', $request->input('email'))->first();
        if ($email) {
            $request->session()->flash('error', 'Email is already in use');

            return view('signup');
        }

        // Check if both passwords are the same
        if ($request->input('password') != $request->input('confirm-password')) {
            $request->session()->flash('error', 'Passwords are not the same');

            return view('signup');
        }

        // Set object properties from the user input
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password')); // Hash the password with BCRYPT
        $user->save();

        return redirect('login');
    }

    public function login()
    {
        return view('login');
    }

    public function handleLogin(Request $request)
    {
        // Get the user's email and password and put them in an array
        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            return redirect('/');
        };

        return view('login');
    }

    public function handleLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
