@extends('layouts/app')

@section('title')
    Chat
@endsection

@section('content')

    <h1>Chats</h1>

    @foreach($friendships as $friendship)
        @if($friendship['latest_chat'])
            <a href="./friends/chat/{{ $friendship['other_user']->id }}">
                <img src="{{ $friendship['other_user']->profilepic }}" alt="">
                <h2>{{ $friendship['other_user']->username }}</h2>
                <p>{{ $friendship['latest_chat']->content }}</p>
                @if($friendship['latest_chat']->status == 'unread')<span style="background-color: #3C7A84; padding: 2px 5px; border-radius: 5px; color: white;">nieuw</span>@endif
            </a>
        @else
            <p>Geen chats beschikbaar</p>
            <h2>Vrienden om mee te chatten</h2>
            <div>
                <h3>{{ $friendship['other_user']->username }}</h3>
                <a class="knop" href="./chat/{{ $friendship['other_user']->id }}">Chat</a>
            </div>
        @endif
    @endforeach

@component('components/navbar')
@endcomponent

@endsection