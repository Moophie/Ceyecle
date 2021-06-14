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
        </a>
    @endforeach

@component('components/navbar')
@endcomponent

@endsection