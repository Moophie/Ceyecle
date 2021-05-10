@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>
                    <img class="logo" src="../images/Logo.png" alt="">

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
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
                                    <input placeholder="Wachtwoord" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button id="btn" type="submit" class="btn btn-primary">
                                        <img src="../images/middel 7-8.png" alt="">
                                    </button>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input placeholder="Wachtwoord bevestigen" id="password" id="password-confirm"
                                        type="password" class="form-control" name="password_confirmation" required
                                        autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                <a href="/register/facebook" class="btn btn-secondary">Sign in with Facebook</a>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                <a href="/register/google" class="btn btn-secondary">Sign in with Google</a>
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
        <button id="btndeco"><a href="login">{{ __('Log in') }}</a></button>
    </div>
@endsection
