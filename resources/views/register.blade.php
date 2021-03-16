@extends('layouts/app')

@section('title')
    Register
@endsection

@section('content')

<div class="register-container">
    <div>
        <div class="header">
            <h1>Login</h1>
        </div>
    </div>

    <div>
        <div class="register-form">
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

                    <input class="btn btn-primary" type="submit" value="Register">
            </form>
        </div>
    </div>
</div>

@endsection