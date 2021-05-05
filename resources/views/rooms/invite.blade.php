@extends('layouts/app')

@section('content')

@foreach($friends as $friend)
<h1>{{ $friend->username }}</h1>
<form action="/rooms/inviteFriend" method="POST">

    {{ csrf_field() }}

    <input type="text" value="{{ $room->id }}" name="room-id" hidden>
    <input type="text" value="{{ $friend->id }}" name="friend-id" hidden>
    <input type="submit" value="Invite">
</form>


@endforeach

@endsection