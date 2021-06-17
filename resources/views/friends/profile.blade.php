@extends('layouts/app')

@section('title')
    Profile
@endsection

@section('content')
    <a href="{{ url()->previous() }}"><img class="terug" src="{{ asset('/images/pijltje.png') }}" alt=""></a>
    <h1>{{ $username }}</h1>

    @if ($profilepic)
        <img class="profilepic" src="{{ $profilepic }}" alt="Profile picture">
    @endif

    <!-- TODO: conditional if already friends (verwijder button) or if pending request -->
    <a class="vrienden" href="/add/{{ $id }}">Toevoegen</a>
    <!-- TODO: if received pending request => add accept request button -->

    <div class="knowme">
        <p>Interesses: {{ $intrests }}</p>
        <p>Leeftijd: {{ $age }}</p>
    </div>

    <div class="kader">
        <h2>Deelgenomen aan</h2>
        <img src="https://via.placeholder.com/100" alt="Event picture">
        <h2>WK Veldrijden 2021</h2>
        <p>30-31/01/2021</p>
        <a class="infoo" href="">Meer info</a>
    </div>

    @component('components/navbar')
    @endcomponent

@endsection
