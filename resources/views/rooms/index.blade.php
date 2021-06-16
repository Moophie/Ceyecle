@extends('layouts/app')

@section('content')
<a href="{{ url()->previous() }}"><img class="terug" src="{{ asset('/images/pijltje.png') }}" alt=""></a>
    <h1>Mijn rooms</h1>

    @foreach ($room_requests as $room_request)
        <div>
            <h3>{{ $room_request->race->name }}</h3>
            <a href="/accept/{{ $room_request->id }}">Accepteren</a>
        </div>
    @endforeach

    @foreach ($rooms as $room)
        <div class="room-container" style="border: solid 2px black; border-radius: 5px; padding:20px">
            <a href="rooms/{{ $room->id }}"><img src="{{ asset('/storage/cycling/logos/' . $room->race->logo) }}"
                    alt="A thumbnail of the relevant race." width="200px;"></a>
            <h1>{{ $room->race->name }}</h1>
        </div>
        <br>
    @endforeach

    @component('components/navbar')
    @endcomponent

@endsection
