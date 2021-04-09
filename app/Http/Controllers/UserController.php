<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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

        $request->session()->flash('error', 'Something went wrong');

        return view('login');
    }

    public function handleLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function profile()
    {
        return view('profile/index');
    }

    public function editProfile()
    {
        return view('profile/edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'intrests' => 'sometimes',
            'age' => 'sometimes|integer|min:0',
            'image' => 'sometimes|mimes:jpg,png,jpeg|max:5048'
        ]);

        // upload profile picture
        if ($request->hasFile('image')) {
            $imageName = time() . '-' . $request->image->getClientOriginalName();
            if (Auth::user()->profilepic) {
                unlink(public_path('images'). '/' . Auth::user()->profilepic);
            }
            $request->image->move(public_path('images'), $imageName);

            User::where('id', Auth::user()->id)
                ->update(['intrests' => $request->input('intrests'), 'age' => $request->input('age'), 'profilepic' => $imageName]);
        } else {
            User::where('id', Auth::user()->id)
                ->update(['intrests' => $request->input('intrests'), 'age' => $request->input('age')]);
        }
    
        return redirect('/profile');
    }
}
