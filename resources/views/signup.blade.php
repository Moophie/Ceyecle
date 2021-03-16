@extends('layouts/app')

@section('title')
    Sign up
@endsection

@section('content')

    <div class="signup-container">
        <div>
            <div class="header">
                <h1>Login</h1>

                @if ($flash = session('error'))
                    <div class="alert alert-danger">{{ $flash }}</div>
                @endif
                
            </div>
        </div>

        <div>
            <div class="signup-form">
                <form action="" method="post">
                    {{ csrf_field() }}
                    <label for="username">Username</label>
                    <input class="form-control" type="text" name="username" id="username">

                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" id="email">

                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password" id="password">

                    <label for="confirm-password">Confirm password</label>
                    <input class="form-control" type="password" name="confirm-password" id="password">

                    <input class="btn btn-primary" type="submit" value="Sign up">
                </form>
            </div>
        </div>
    </div>

@endsection
