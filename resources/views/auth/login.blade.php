@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>
                    <img class="logo" src="../images/Logo.png" alt="">
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
                                <img src="../images/middel 7-8.png" alt="">
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

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <!--  <button id="btndeco" type="submit" class="btn btn-primary">
                                        {{ __('Aanmelden') }}
                                    </button> -->

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                <a href="/register/facebook" class="btn btn-secondary">Login with Facebook</a>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                <a href="/register/google" class="btn btn-secondary">Login with Google</a>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                <a href="/register/twitter" class="btn btn-secondary">Login with Twitter</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <hr>
    <div class="winnaar" style="background-image: url(../images/winnaar.png);height:400px;width:514px;">
        <button id="btndeco"><a href="register">{{ __('Aanmelden') }}</a></button>
    </div>

@endsection
