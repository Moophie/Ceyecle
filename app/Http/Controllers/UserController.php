<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function signup()
    {
        return view('auth/register');
    }

    public function handleSignup(Request $request)
    {
        $user = new User();

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Check if email is unique
        $email = $user::where('email', $request->input('email'))->first();
        if ($email) {
            $request->session()->flash('error', 'Email is already in use');

            return view('auth/register');
        }

        // Check if both passwords are the same
        if ($request->input('password') != $request->input('confirm-password')) {
            $request->session()->flash('error', 'Passwords are not the same');

            return view('auth/register');
        }

        // Set object properties from the user input
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password')); // Hash the password with BCRYPT
        $user->save();

        return redirect('auth/login');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function handleLogin(Request $request)
    {
        // Get the user's email and password and put them in an array
        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            return redirect('/');
        };

        $request->session()->flash('error', 'Something went wrong');

        return view('auth/login');
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
                if (substr(Auth::user()->profilepic, 0, 4) != "http") {
                    unlink(public_path('images/profile_pic') . str_replace( url('images/profile_pic/'), "", Auth::user()->profilepic));
                }
            }
            $request->image->move(public_path('images/profile_pic'), $imageName);

            User::where('id', Auth::user()->id)
                ->update(['intrests' => $request->input('intrests'), 'age' => $request->input('age'), 'profilepic' => url('images/profile_pic/'.$imageName)]);
        } else {
            User::where('id', Auth::user()->id)
                ->update(['intrests' => $request->input('intrests'), 'age' => $request->input('age')]);
        }
    
        return redirect('/profile');
    }

    public function facebook()
    {
        // send user's request to Facebook
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookRedirect()
    {
        // get oauth request back from facebook
        $facebookUser = Socialite::driver('facebook')->user();

        $user = User::where('email', '=', $facebookUser->getEmail())->first();
        
        //  if this user doesn't exist, add them
        if (!$user) {
            $u = new User();
            $u->username = $facebookUser->getName();
            $u->email = $facebookUser->getEmail();
            $u->password = Hash::make(Str::random(20));
            $u->profilepic = $facebookUser->getAvatar();
            $u->save();
            Auth::login($u, true);
        } else {
            Auth::login($user, true);
        }

        return redirect('/');
    }

    public function google()
    {
        // send user's request to Google
        return Socialite::driver('google')->redirect();
    }

    public function googleRedirect()
    {
        // get oauth request back from Google
        $googleUser = Socialite::driver('google')->user();

        $user = User::where('email', '=', $googleUser->getEmail())->first();
        
        //  if this user doesn't exist, add them
        if (!$user) {
            $u = new User();
            $u->username = $googleUser->getName();
            $u->email = $googleUser->getEmail();
            $u->password = Hash::make(Str::random(20));
            $u->profilepic = $googleUser->getAvatar();
            $u->save();
            Auth::login($u, true);
        } else {
            Auth::login($user, true);
        }

        return redirect('/');
    }

    public function twitter()
    {
        // send user's request to Twitter
        return Socialite::driver('twitter')->redirect();
    }

    public function twitterRedirect()
    {
        // get oauth request back from twitter
        $twitterUser = Socialite::driver('twitter')->user();
        $user = User::where('email', '=', $twitterUser->getEmail())->first();
        
        //  if this user doesn't exist, add them
        if (!$user) {
            $u = new User();
            $u->username = $twitterUser->getName();
            $u->email = $twitterUser->getEmail();
            $u->password = Hash::make(Str::random(20));
            $u->profilepic = $twitterUser->getAvatar();
            $u->save();
            Auth::login($u, true);
        } else {
            Auth::login($user, true);
        }

        return redirect('/');
    }
}
