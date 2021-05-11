@extends('layouts/app')

@section('title')
    Home
@endsection

@section('content')

    <div>
        <img class="logoklein" src="../images/LK-8.png" alt="">
        <img class="profiel" src="../images/Profiel_2-8.png" alt="">
        <div class="header">
            <p>Ethias Cross Eeklo 2021</p>
        </div>
    </div>

    <!-- test link -->
    <a href="rooms">My rooms<a>

            <h1>Huidige evenementen</h1>

            <!-- Event template, make dynamic -->
            @foreach ($ongoing_races as $race)
                <div class="race-event">
                    <div class="evenement">
                        <h2>{{ $race->name }}</h2>
                        <img class="race" src="{{ $race->logo }}" alt="Event image" style="max-height: 50px; max-width: 100px">
                        <p>{{ $race->date }}</p>
                        <a href="/races/{{ $race->id }}">Meer info</a>
                        <form action="/rooms/create" method="POST">

                            {{ csrf_field() }}

                            <input type="text" value="{{ $race->id }}" name="race-id" hidden>
                            <input type="submit" value="Create room">
                        </form>
                    </div>
                </div>
            @endforeach

            <h1>Opkomende evenementen</h1>

            @foreach ($upcoming_races as $race)
                <div class="race-event">
                    <div class="evenement">
                        <h2>{{ $race->name }}</h2>
                        <img class="race" src="{{ $race->logo }}" alt="Event logo" style="max-height: 50px; max-width: 100px">
                        <p>{{ $race->date }}</p>
                        <a href="/races/{{ $race->id }}">Meer info</a>
                        <form action="/rooms/create" method="POST">

                            {{ csrf_field() }}

                            <input type="text" value="{{ $race->id }}" name="race-id" hidden>
                            <input type="submit" value="Create room">
                        </form>
                    </div>
                </div>
            @endforeach

            @component('components/navbar')

            @endcomponent

        @endsection
