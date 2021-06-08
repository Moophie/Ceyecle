@extends('layouts/app')

@section('title')
    Profile
@endsection

@section('content')

    <h1>Mijn profiel</h1>
    @if (Auth::user()->profilepic)
        <img src="{{ Auth::user()->profilepic }}" alt="Profile picture">
    @endif
    <h2>{{ Auth::user()->username }}</h2>
    <a class="logout"href="./logout">Log out</a>
    <a class="edit" href="./editProfile">Edit</a>
    <a class="vrienden" href="./friends/list" >Bekijk vriendenlijst</a>
    <div class="knowme">
        <p class="me">Interesses: {{ Auth::user()->intrests }}</p>
        <p class="me">Leeftijd: {{ Auth::user()->age }}</p>
    </div>


    <div class="kader">
    <h2>Deelgenomen aan</h2>
        <img src="https://via.placeholder.com/100" alt="Race picture">
        <h2>WK Veldrijden 2021</h2>
        <p class="me">30-31/01/2021</p>
        <a class="infoo" href="">Meer info</a>
    </div>

    @component('components/navbar')
    @endcomponent

@endsection
