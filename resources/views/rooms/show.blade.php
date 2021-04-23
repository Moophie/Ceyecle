@extends('layouts/app')

@section('content')
<h1>{{ $room->event->name }}</h1>
<form action="/rooms/invite" method="POST">

    {{ csrf_field() }}

    <input type="text" value="{{ $room->id }}" name="room-id" hidden>
    <input type="submit" value="Invite friends">
</form>
@endsection