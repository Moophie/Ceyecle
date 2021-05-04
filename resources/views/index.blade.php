@extends('layouts/app')

@section('title')
    Home
@endsection

@section('content')

<img class="logoklein" src="../public/images/LK-8.png" alt="">
<img class="profiel" src="../public/images/Profiel_2-8.png" alt="">

<div class="header">
    <p>Ethias Cross Eeklo 2021</p>
</div>

<h1>Opkomende evenementen</h1>

<!-- Event template, make dynamic -->
@foreach ($upcoming_events as $event)
<div class="race-event">
    <div class="evenement">
    <img class="race" src="https://via.placeholder.com/100" alt="Event image">
    <h2>{{ $event->name }}</h2>
    <p>{{ $event->date }}</p>
    <a>Meer info</a>
    </div>
    <form action="/rooms/create" method="POST">

        {{ csrf_field() }}

        <input type="text" value="{{ $event->id }}" name="event-id" hidden>
        <input type="submit" value="Create room">
    </form>
</div>
@endforeach

@component('components/navbar')

@endcomponent

@endsection