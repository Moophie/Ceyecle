@extends('layouts/app')

@section('content')

@foreach($rooms as $room)
<div class="room-container">
    <h1>{{ $room->id }}</h1>
    <h1>{{ $room->event_id }}</h1>
</div>
@endforeach

@endsection