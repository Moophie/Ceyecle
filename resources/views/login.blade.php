@extends('layouts/app')

@section('title')
    Login
@endsection

@section('content')

<div class="login-container">
    <div>
        <div class="header">
            <h1>Login</h1>
        </div>
    </div>

    <div>
        <div class="login-form">
            <form action="" method="post">
                {{ csrf_field() }}
                <label for="username">UserName</label>
                <input class="form-control" type="username" name="username" id="username">

                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password">

                <input class="btn btn-primary" type="submit" value="Login">
                <a href="/signup">Sign up</a>
            </form>
        </div>
    </div>
</div>

@endsection