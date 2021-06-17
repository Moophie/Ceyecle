@extends('layouts/app')

@section('content')
    <a href="{{ url()->previous() }}"><img class="terug" src="{{ asset('/images/pijltje.png') }}" alt=""></a>
    <h1>{{ $room->race->name }}</h1>
    @if ($current_stage !== 'No stage going on for this race')
        <h2>Current stage: {{ $current_stage->name }}</h2>
        <img class="profilepic" src="{{ asset('/storage/cycling/stages/' . $current_stage->profile_img) }}" alt=""
            width="500px">
    @else
        <h2>Current stage: {{ $current_stage }}</h2>
    @endif
    <h1>Teams</h1>
    <ul>
        @foreach ($participating_teams as $team)
            <li>{{ $team->name }}</li>
        @endforeach
    </ul>

    <h1>Viewers</h1>

    @foreach ($room->users as $user)
        <p class="me">{{ $user->username }}</p>
    @endforeach

    @if (!empty($top25))
        <h1>Top 25</h1>
        <ol>
            @foreach ($top25 as $rider)
                <li>{{ $rider->firstname }} {{ $rider->lastname }}</li>
            @endforeach
        </ol>
    @endif


    <h1>Chat</h1>

    <div class="show-chat">
        @foreach ($room->messages as $message)
            <p>{{ $message->user->username }}: {{ $message->content }}</p>
        @endforeach
    </div>

    <form class="chatbox" action="/rooms/chat" method="POST">
        {{ csrf_field() }}

        <input type="text" value="{{ $room->id }}" name="room-id" hidden>
        <input type="text" value="{{ Auth::user()->id }}" name="user-id" hidden>
        <input class="text" type="textarea" name="message-content">
        <input class="knop" type="submit" value="Send message">
    </form>

    <form action="/rooms/invite" method="POST">
        {{ csrf_field() }}

        <input type="text" value="{{ $room->id }}" name="room-id" hidden>
        <input id="knop" class="knop" type="submit" value="Invite friends">
    </form>

    @if ($current_stage !== 'No stage going on for this race')
        <h2>Room Question</h2>

        @if ($question)
            <form action="/answerQuestion" method="POST">
                {{ csrf_field() }}

                {{ $question->question }}

                <input type="hidden" value="{{ $question->id }}" name="question-id" hidden>
                <input type="hidden" value="{{ $room->id }}" name="room-id" hidden>
                <input type="hidden" value="{{ Auth::user()->id }}" name="user-id" hidden>
                <input type="text" name="question-answer">
                <input type="submit" value="Answer">
            </form>
        @endif

        <form action="/rooms/raceQuestion" method="POST">
            {{ csrf_field() }}

            <input type="text" value="{{ $room->id }}" name="room-id" hidden>
            <input type="submit" value="Test Race Question">
        </form>

        <form action="/rooms/riderQuestion" method="POST">
            {{ csrf_field() }}

            <input type="text" value="{{ $current_stage->id }}" name="stage-id" hidden>
            <input type="text" value="{{ $room->id }}" name="room-id" hidden>
            <input type="submit" value="Test Rider Question">
        </form>
    @endif

    @component('components/navbar')
    @endcomponent
@endsection
