@extends('layouts/app')

@section('title')
    Home
@endsection

@section('content')

<div class="header">
    <img src="https://via.placeholder.com/50" alt="Ceyecle small logo">
    <div class="current-races"><p>ETHIAS CROSS EEKLO 2021</p><img src="" alt=""></div>
    <img src="https://via.placeholder.com/50" alt="Profile icon">
</div>

<h1>Upcoming Races</h1>

@foreach ($upcoming_races as $race)
<div class="race">
    <img src="https://via.placeholder.com/100" alt="Race image">
    <h2>{{ $race->name }}</h2>
    <p>{{ $race->date }}</p>
    <a>Meer info</a>
    <form action="/rooms/create" method="POST">

        {{ csrf_field() }}

        <input type="text" value="{{ $race->id }}" name="race-id" hidden>
        <input type="submit" value="Create room">
    </form>
</div>
@endforeach

@component('components/navbar')

@endcomponent

@endsection