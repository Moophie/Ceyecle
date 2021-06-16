@extends('layouts/app')

@section('title')
    Chat
@endsection

@section('content')
    <a href="{{ url()->previous() }}"><img class="terug" src="{{ asset('/images/pijltje.png') }}" alt=""></a>
    <h1>Chats</h1>
    <h2>Conversaties</h2>
    @foreach ($friendships as $friendship)
        @if ($friendship['latest_chat'])
            <div class="chat-box">
                <a href="/friends/chat/{{ $friendship['other_user']->id }}">
                    <div>
                        <h2>{{ $friendship['other_user']->username }}</h2>
                        <p>{{ $friendship['latest_chat']->content }}</p>
                    </div>
                    @if ($friendship['latest_chat']->status == 'unread')<span
                            style="background-color: #3C7A84; padding: 2px 5px; border-radius: 5px; color: white;">nieuw</span>
                    @endif
                    <img class="profilepic" src="{{ $friendship['other_user']->profilepic }}" alt="">
                </a>
            </div>
        @else
            <div>
                <h3>{{ $friendship['other_user']->username }}</h3>
                <a class="knop" href="/friends/chat/{{ $friendship['other_user']->id }}">Chat</a>
            </div>
        @endif
    @endforeach

    @component('components/navbar')
    @endcomponent

@endsection
