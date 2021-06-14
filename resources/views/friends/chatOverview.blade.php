@extends('layouts/app')

@section('title')
    Chat
@endsection

@section('content')

    <h1>Chats</h1>

    @foreach($friendships as $friendship)
        <a href="./friends/chat/{{ $friendship['other_user']->id }}">
            <img src="{{ $friendship['other_user']->profilepic }}" alt="">
            <h2>{{ $friendship['other_user']->username }}</h2>
            <p>{{ $friendship['latest_chat']->content }}</p>
            @if($friendship['latest_chat']->status == 'unread')<span style="background-color: #3C7A84; padding: 2px 5px; border-radius: 5px; color: white;">nieuw</span>@endif
        </a>
    @endforeach

@component('components/navbar')
@endcomponent

@endsection