@extends('layouts/app')

@section('title')
    Home
@endsection

@section('content')

    <div>
        <img class="logoklein" src="../public/images/LK-8.png" alt="">
       <a href="./profile/"> <img class="profiel" src="../public/images/icons/Profiel_2-8.png" alt=""></a>
        <div class="header">
        <p>Nu bezig: Ethias Cross Eeklo 2021</p>
        </div>
    </div>

    <!-- test link -->
    <a class="kamer" href="./rooms">Mijn rooms</a>

            <h1>Huidige evenementen</h1>

            <!-- Event template, make dynamic -->
            @foreach ($ongoing_races as $race)
                <div class="race-event">
                    <div class="evenement">
                        <img class="races" src="{{ $race->logo }}" alt="Event image">
                        <h2>{{ $race->name }}</h2>
                        <p>{{ $race->date }}</p>
                        <a class="info" href="./races/{{ $race->id }}">Meer info</a>
                        <form class="create" action="./rooms/create" method="POST">

                            {{ csrf_field() }}

                        <input type="text" value="{{ $race->id }}" name="race-id" hidden>
                        <input class="knop" type="submit" value="Create room">
                        </form>
                    </div>
                </div>
            @endforeach

            <h1>Opkomende evenementen</h1>

            @foreach ($upcoming_races as $race)
                <div class="race-event">
                    <div class="evenement">
                        <img class="races" src="{{ $race->logo }}" alt="Event logo">
                        <h2>{{ $race->name }}</h2>
                        <p>{{ $race->date }}</p>
                        <a class="info" href="./races/{{ $race->id }}">Meer info</a>
                        <form class="createone" action="./rooms/create" method="POST">

                            {{ csrf_field() }}

                        <input type="text" value="{{ $race->id }}" name="race-id" hidden>
                        <input class="knop" type="submit" value="Create room">
                        </form>
                    </div>
                </div>
            @endforeach

            @component('components/navbar')

            @endcomponent

        @endsection
