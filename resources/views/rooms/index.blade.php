@extends('layouts/app')

@section('content')
    <h1>My Rooms</h1>

    @foreach ($rooms as $room)
        <div class="room-container">
            <a href="/rooms/{{ $room->id }}"><img src="https://via.placeholder.com/150" alt="A thumbnail of the relevant race."></a>
            <h1>{{ $room->event->name }}</h1>
        </div>
    @endforeach

@endsection
