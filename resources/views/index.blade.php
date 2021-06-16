@extends('layouts/app')

@section('title')
    Home
@endsection

@section('content')

    <div>
        <img class="logoklein" src="{{ asset('/images/LK-8.png') }}" alt="">
        <a href="/profile/"> <img class="profiel" src="{{ asset('/images/icons/Profiel_2-8.png') }}" alt=""></a>
        <div class="header">
            <p>Nu bezig: Ethias Cross Eeklo 2021</p>
        </div>
    </div>

    <a class="kamer" href="/rooms">Mijn rooms</a>
    @if (count($rooms) > 0)<span
            style="position: absolute; z-index: 5; right: 0px;  font-size: 12px; background-color: #3C7A84; padding: 1px 5px; border-radius: 5px; color: white;">{{ count($rooms) }}</span>
    @endif

    <h1>Huidige evenementen</h1>

    <!-- Event template, make dynamic -->
    @foreach ($ongoing_races as $race)
        <div class="race-event">
            <div class="evenement">
                <img class="races" src="{{ asset('/storage/cycling/logos/' . $race->logo) }}" alt="Event image">
                <h2>{{ $race->name }}</h2>
                <p>{{ $race->date }}</p>
                <a class="info" href="/races/{{ $race->id }}">Meer info</a>
                <form class="create" action="/rooms/create" method="POST">

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
                <img class="races" src="{{ asset('/storage/cycling/logos/' . $race->logo) }}" alt="Event logo">
                <h2>{{ $race->name }}</h2>
                <p>{{ $race->date }}</p>
                <a class="info" href="/races/{{ $race->id }}">Meer info</a>
                <form class="createone" action="/rooms/create" method="POST">

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

@section('extra-scripts')
    <script>
        var device_key = '{{ $device_key }}';

    </script>
    <script src="{{ asset('js/index.js') }}"></script>
@endsection
