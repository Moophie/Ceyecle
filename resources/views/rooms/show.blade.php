@extends('layouts/app')

@section('content')
    <h1>{{ $room->event->name }}</h1>
    <img src="/images/stage_profiles/example.jpg" alt="">

    <h1>Viewers</h1>
    @foreach ($room->users as $user)
        <p>{{ $user->username }}</p>
    @endforeach

    <h1>Chat</h1>
    <div class="show-chat">
        @foreach ($room->messages as $message)
        <p>{{ $message->content }}</p>
    @endforeach
    </div>
    <form action="/rooms/chat" method="POST">
        {{ csrf_field() }}

        <input type="text" value="{{ $room->id }}" name="room-id" hidden>
        <input type="text" value="{{ Auth::user()->id }}" name="user-id" hidden>
        <input type="textarea" name="message-content">
        <input type="submit" value="Send message">
    </form>
    <form action="/rooms/invite" method="POST">
        {{ csrf_field() }}

        <input type="text" value="{{ $room->id }}" name="room-id" hidden>
        <input type="submit" value="Invite friends">
    </form>
@endsection
