@extends('layouts/app')

@section('title')
    Profile
@endsection

@section('content')

    <h1>My profile</h1>
    <h2>{{ Auth::user()->username }}</h2>
    <a href="/logout">Log out</a>
    <a href="/editProfile">Edit</a>

    @if (Auth::user()->profilepic)
        @if(substr(Auth::user()->profilepic, 0, 4) === "http")
            <img src="{{ Auth::user()->profilepic }}" alt="Profile picture">
        @else
            <img src="{{ asset('images/' . Auth::user()->profilepic) }}" alt="Profile picture">
        @endif
    @endif

    <div>
        <p>Interesses: {{ Auth::user()->intrests }}</p>
        <p>Leeftijd: {{ Auth::user()->age }}</p>
    </div>

    <h2>Deelgenomen aan</h2>

    <div>
        <img src="https://via.placeholder.com/100" alt="Race picture">
        <h2>WK Veldrijden 2021</h2>
        <p>30-31/01/2021</p>
        <a href="">Meer info</a>
    </div>

    @component('components/navbar')
    @endcomponent

@endsection
