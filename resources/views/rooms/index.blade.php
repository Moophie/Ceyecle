@extends('layouts/app')

@section('content')
    <h1>My Rooms</h1>

    @foreach ($room_requests as $room_request)
        <div>
            <h3>{{ $room_request->race->name }}</h3>
            <a href="rooms/accept/{{ $room_request->id }}">Accepteren</a>
        </div>
    @endforeach

    @foreach ($rooms as $room)
        <div class="room-container">
            <a href="/rooms/{{ $room->id }}"><img src="https://via.placeholder.com/150"
                    alt="A thumbnail of the relevant race."></a>
            <h1>{{ $room->race->name }}</h1>
        </div>
    @endforeach

@endsection
