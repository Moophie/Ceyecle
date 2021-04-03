@extends('layouts/app')

@section('title')
    Profile
@endsection

@section('content')

<h1>{{ Auth::user()->username }}</h1>

<img src="https://via.placeholder.com/100" alt="Profile picture">


<div>
    <form class="form-group" action="/updateInfo" method="POST">
        {{ csrf_field() }}
        <label for="intrests">Interesses</label>
        <input class="form-control" type="text" name="intrests" id="intrests" value="{{ Auth::user()->intrests }}">

        <label for="age">Leeftijd</label>
        <input class="form-control" type="number" name="age" id="age" value="{{ Auth::user()->age }}">
            
        <input type="submit" class="btn btn-primary" value="Save">
    </form>
</div>

<h2>Deelgenomen aan</h2>

<div>
    <img src="https://via.placeholder.com/100" alt="Event picture">
    <h2>WK Veldrijden 2021</h2>
    <p>30-31/01/2021</p>
    <a href="">Meer info</a>
</div>

@component('components/navbar')
@endcomponent

@endsection