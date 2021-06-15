@extends('layouts/app')

@section('title')
    Chat
@endsection

@section('content')
<a href="{{ url()->previous() }}"><img class="terug" src="{{ asset('/images/pijltje.png') }}" alt=""></a>
    <h1>Chats</h1>
    <h2>Vrienden om mee te chatten</h2>
    @foreach($friendships as $friendship)
        @if($friendship['latest_chat'])
            <a href="./friends/chat/{{ $friendship['other_user']->id }}">
                <img src="{{ $friendship['other_user']->profilepic }}" alt="">
                <h2>{{ $friendship['other_user']->username }}</h2>
                <p class="me">{{ $friendship['latest_chat']->content }}</p>
                @if($friendship['latest_chat']->status == 'unread')<span style="background-color: #3C7A84; padding: 2px 5px; border-radius: 5px; color: white;">nieuw</span>@endif
            </a>
        @else
            <div>
                <h3>{{ $friendship['other_user']->username }}</h3>
                <a class="knop" href="./friends/chat/{{ $friendship['other_user']->id }}">Chat</a>
            </div>
        @endif
    @endforeach

@component('components/navbar')
@endcomponent

@endsection