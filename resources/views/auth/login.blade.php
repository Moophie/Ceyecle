@extends('layouts.app')

@section('title')
    Login
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>
                    <img class="logo" src="{{ asset('/images/Logo.png') }}" alt="">
                    <div class="card-body" id="form">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input class="action" placeholder="E-mail" id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input placeholder="Wachtwoord" id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <button id="btn" type="submit" class="btn btn-primary">
                                <img src="{{ asset('/images/arrow-right.png') }}" alt="">
                            </button>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <!--<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label> -->
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row mb-0">
                                <btn id="inlogbtn" class="col-md-8 offset-md-4">
                                    <!--  <button id="btndeco" type="submit" class="btn btn-primary">
                                        {{ __('Aanmelden') }}
                                    </button> -->

                                    @if (Route::has('password.request'))
                                        <a id="login" class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </btn>
                            </div>
                            <br>
                            <div class="form-group row">
                                <btn id="inlogbtn" class="col-md-6">
                                <img class="loginlogo" src="{{ asset('/images/facebook.svg') }}" alt="">
                                <a id="login" href="./register/facebook" class="btn btn-secondary">Login with Facebook</a>
                                </btn>
                            </div>
                            <br>
                            <div class="form-group row">
                                <btn id="inlogbtn" class="col-md-6">
                                <img class="loginlogo" src="{{ asset('/images/google.png') }}" alt="">
                                <a id="login" href="./register/google" class="btn btn-secondary">Login with Google</a>
                                </btn>
                            </div>
                            <br>
                            <div class="form-group row">
                                <btn id="inlogbtn" class="col-md-6">
                                <img class="loginlogo" src="{{ asset('/images/twitter.png') }}" alt="">
                                <a id="login" href="./register/twitter" class="btn btn-secondary">Login with Twitter</a>
                                </btn>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <hr>
    <img class="winnaar" src="{{ asset('/images/winnaar.jpg') }}" alt="">
    <button id="btndecoo"><a id="btndecoa" href="register">{{ __('Aanmelden') }}</a></button>
    
@endsection
