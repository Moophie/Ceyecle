@extends('layouts/app')

@section('title')
    Profile
@endsection

@section('content')
    <a href=""><img class="terug" src="{{ asset('/images/pijltje.png') }}" alt=""></a>
    <h1>Mijn profiel</h1>
    @if (Auth::user()->profilepic)
        <img class="profilepic" src="{{ Auth::user()->profilepic }}" alt="Profile picture">
    @endif
    <h2>{{ Auth::user()->username }}</h2>
    <a class="vrienden" href="/friends/list">Bekijk vriendenlijst</a>
    <div class="profile-buttons">
        <a class="logout" href="/logout">Log out</a>
        <a class="edit" href="/editProfile">Edit</a>
    </div>
    <div class="knowme">
        <p class="me">Interesses: {{ Auth::user()->intrests }}</p>
        <p class="me">Leeftijd: {{ Auth::user()->age }}</p>
    </div>

    <div class="kader" style="height: auto; padding-bottom: 20px">
        <h2>Laatst gekeken naar</h2>
        <img src="{{ asset('/storage/cycling/logos/' . $last_race->logo) }}" alt="Race picture" style="max-width: 50%">
        <h2>{{ $last_race->name }}</h2>
        <p class="me">{{$last_race->startdate}} tot {{$last_race->enddate}}</p>
        <a class="infoo" href="">Meer info</a>
    </div>

    @component('components/navbar')
    @endcomponent

@endsection
