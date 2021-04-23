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

<h1>Upcoming events</h1>

<!-- Event template, make dynamic -->
@foreach ($upcoming_events as $event)
<div class="race-event">
    <img src="https://via.placeholder.com/100" alt="Event image">
    <h2>{{ $event->name }}</h2>
    <p>{{ $event->date }}</p>
    <a>Meer info</a>
    <form action="/rooms/create" method="POST">
        <input type="text" value="{{ $event->id }}" disabled>
        <input type="submit">
    </form>
</div>
@endforeach

@component('components/navbar')

@endcomponent

@endsection