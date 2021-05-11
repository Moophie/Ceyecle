@extends('layouts/app')

@section('content')
    <h1>{{ $room->race->name }}</h1>
    <img src="/images/stage_profiles/example.jpg" alt="" width="300px">

    <h1>Participants</h1>

    <h1>Viewers</h1>

    @foreach ($room->users as $user)
        <p>{{ $user->username }}</p>
    @endforeach

    <h1>Top 25</h1>
    <ol>
        @foreach ($top25 as $rider)
            <li>{{ $rider['name'] }}</li>

        @endforeach
    </ol>


    <h1>Chat</h1>

    <div class="show-chat">
        @foreach ($room->messages as $message)
            <p>{{ $message->user->username }}: {{ $message->content }}</p>
        @endforeach
    </div>

    <h2>Room Question</h2>

    @if ($question)
        <form action="/rooms/answerQuestion" method="POST">
            {{ csrf_field() }}

            {{ $question->question }}

            <input type="text" value="{{ $question->id }}" name="question-id" hidden>
            <input type="text" value="{{ $room->id }}" name="room-id" hidden>
            <input type="text" name="question-answer">
            <input type="submit" value="Answer">
        </form>
    @endif


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

    <form action="/rooms/raceQuestion" method="POST">
        {{ csrf_field() }}

        <input type="text" value="{{ $room->id }}" name="room-id" hidden>
        <input type="submit" value="Get Race Question">
    </form>
@endsection
