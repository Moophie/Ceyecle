@extends('layouts/app')

@section('title')
    Chat
@endsection

@section('content')
<a href="{{ url()->previous() }}"><img class="terug" src="{{ asset('/images/pijltje.png') }}" alt=""></a>
    <h1>Chat with {{ $friend->username }}</h1>

    <div class="show-chat">
        @foreach ($chat as $message)
            <p>{{ $message->user->username }}: {{ $message->content }}</p>
        @endforeach
    </div> 

    <form action="/friends/chat" method="POST">
        {{ csrf_field() }}

        <input type="text" value="{{ $friendship->id }}" name="friendship-id" hidden>
        <input type="text" value="{{ Auth::user()->id }}" name="user-id" hidden>
        <input type="text" value="{{ $friend->id }}" name="friend-id" hidden>
        <input type="textarea" name="message-content">
        <input type="submit" value="Send message">

    </form>

@component('components/navbar')
@endcomponent

@endsection