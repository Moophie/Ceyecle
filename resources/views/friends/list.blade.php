@extends('layouts.app')

@section('title')
    Vriendenlijst
@endsection

@section('content')

    <h2>Vriendschapsverzoeken</h2>
    @foreach($requests as $request)
        <div>
            <h3>{{ $request->username }}</h3>
            <a href="accept/{{ $request->id }}">Accepteren</a>
        </div>
    @endforeach

    <h2>Vrienden</h2>
    @foreach($friends as $friend)
        <div>
            <h3>{{ $friend->username }}</h3>
            <a href="chat/{{ $friend->id }}">Chat</a>
        </div>
    @endforeach

    @component('components/navbar')
    @endcomponent

@endsection