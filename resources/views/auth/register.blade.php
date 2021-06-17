@extends('layouts.app')

@section('title')
    Register
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>
                <img class="logo" src="{{ asset('/images/Logo.png') }}" alt="">

                <div class="card-body">
                    <form class="formone" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-6">
                                <input placeholder="Naam" id="email" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <input placeholder="E-mail" id="mail" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <input placeholder="Wachtwoord" id="mail" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <input placeholder="Wachtwoord bevestigen" id="password" id="password-confirm"
                                    type="password" class="form-control" name="password_confirmation" required
                                    autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="btnn" type="submit" class="btn btn-primary">
                                    <img src="{{ asset('/images/arrow-right.png') }}" alt="">
                                </button>
                            </div>
                        </div>

                        <div class="social-logins">
                            <a href="/register/facebook"><img class="loginlogo" src="{{ asset('/images/facebook.svg') }}"
                                    alt=""></a>

                            <a href="/register/google"><img class="loginlogo" src="{{ asset('/images/google.png') }}"
                                    alt=""></a>

                            <a href="/register/twitter"><img class="loginlogo" src="{{ asset('/images/twitter.png') }}"
                                    alt=""></a>
                        </div>
                </div>

                </form>
            </div>
        </div>
    </div>

    <div class="login-hero">
        <hr>
        <button id="btndeco"><a id="btndecoa" href="login">{{ __('Log in') }}</a></button>
    </div>

@endsection
