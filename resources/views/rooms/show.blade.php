@extends('layouts/app')

@section('content')
    <a href="{{ url()->previous() }}"><img class="terug" src="{{ asset('/images/pijltje.png') }}" alt=""></a>
    <h1>{{ $room->race->name }}</h1>
    <div class="stage-summary">
        @if ($current_stage !== 'No stage going on for this race')
            <h2>{{ $current_stage->name }}</h2>
            <img class="room-pic" src="{{ asset('/storage/cycling/stages/' . $current_stage->profile_img) }}" alt=""
                width="90%">
        @else
            <h2>{{ $current_stage }}</h2>
        @endif
    </div>
    <div id="teams-modal" class="modal">
        <div class="modal-content">
            <h1>Teams</h1>
            <div>
                <ul>
                    @foreach ($participating_teams as $team)
                        <li>{{ $team->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div id="viewers-modal" class="modal">
        <div class="modal-content">
            <h1>Viewers</h1>
            <div>
                @foreach ($room->users as $user)
                    <p class="me">{{ $user->username }}</p>
                @endforeach
                <form action="/rooms/invite" method="POST">
                    {{ csrf_field() }}
                    <input type="text" value="{{ $room->id }}" name="room-id" hidden>
                    <input id="knop" class="knop" type="submit" value="Invite friends">
                </form>
            </div>
        </div>
    </div>

    <div id="top25-modal" class="modal">
        <div class="modal-content">
            @if (!empty($top25))
                <h1>Top 25</h1>
                <ol>
                    @foreach ($top25 as $rider)
                        <li>{{ $rider->firstname }} {{ $rider->lastname }}</li>
                    @endforeach
                </ol>
            @endif
        </div>
    </div>

    <div class="room-text">

        @if ($current_stage !== 'No stage going on for this race')
            <div class="room-question">
                <h2>Room Question</h2>
                @if ($question)
                    <form action="/rooms/answerQuestion" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ $question->id }}" name="question-id" hidden>
                        <input type="hidden" value="{{ $room->id }}" name="room-id" hidden>
                        <input type="hidden" value="{{ Auth::user()->id }}" name="user-id" hidden>
                        <label for="question-answer">{{ $question->question }}</label>
                        <div>
                            <input type="text" name="question-answer" id="question-answer">
                            <input class="knop" type="submit" value="Answer">
                        </div>
                    </form>
                @endif
            </div>
        @endif
        <div class="room-chat">
            <h2>Chat</h2>
            <div class="show-chat">
                @foreach ($room->messages as $message)
                    <p><span style="font-size: 12px;">{{ $message->user->username }}</span>
                        <br>
                        {{ $message->content }}
                    </p>
                @endforeach
            </div>
            <form class="chatbox" action="/rooms/chat" method="POST">
                {{ csrf_field() }}
                <input type="text" value="{{ $room->id }}" name="room-id" hidden>
                <input type="text" value="{{ Auth::user()->id }}" name="user-id" hidden>
                <div class="flex">
                    <input class="text" type="textarea" name="message-content">
                    <input class="knop" type="submit" value="Send">
                </div>
            </form>
        </div>
    </div>

    <div class="room-detail-modals">
        <button class="knop" id="top25-modal-button">First 25</button>
        <button class="knop" id="teams-modal-button">Teams</button>
        <button class="knop" id="viewers-modal-button">Viewers</button>
    </div>

    @component('components/navbar')
    @endcomponent

@section('extra-scripts')
    <script src="{{ asset('js/room.js') }}"></script>
@endsection
@endsection
