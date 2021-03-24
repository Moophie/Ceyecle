@extends('layouts/app')

@section('title')
    Home
@endsection

@section('content')

<img src="https://via.placeholder.com/50" alt="Ceyecle small logo">
<div class="current-races"><p>ETHIAS CROSS EEKLO 2021</p><img src="" alt=""></div><img src="https://via.placeholder.com/50" alt="Profile icon">

<h1>Upcoming events</h1>

<!-- Event template, make dynamic -->
<div class="race-event">
    <img src="https://via.placeholder.com/100" alt="Event image">
    <h2>Kuurne-Brussel-Kuurne</h2>
    <p>28/02/2021</p>
    <a>Meer info</a>
</div>

@component('components/navbar')

@endcomponent

@endsection