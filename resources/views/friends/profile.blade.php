@extends('layouts/app')

@section('title')
    Profile
@endsection

@section('content')

    <h1>{{ $username }}</h1>

    @if ($profilepic)
        <img src="{{ asset('images/' . $profilepic) }}" alt="Profile picture">
    @endif

    <a href="/add/{{ $id }}">Toevoegen</a>

    <div>
        <p>Interesses: {{ $intrests }}</p>
        <p>Leeftijd: {{ $age }}</p>
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
