@extends('layouts/app')

@section('content')
    <h1>{{ $room->event->name }}</h1>
    <img src="/images/stage_profiles/example.jpg" alt="">

    <h1>Viewers</h1>
    @foreach ($room->users as $user)
        <p>{{ $user->username }}</p>
    @endforeach
    <form action="/rooms/invite" method="POST">

        {{ csrf_field() }}

        <input type="text" value="{{ $room->id }}" name="room-id" hidden>
        <input type="submit" value="Invite friends">
    </form>
@endsection
