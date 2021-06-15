@extends('layouts/app')

@section('content')

@foreach($friends as $friend)
<a href=""><img class="terug" src="{{ asset('/images/pijltje.png') }}" alt=""></a>
<h1>{{ $friend->username }}</h1>
<form action="./inviteFriend" method="POST">

    {{ csrf_field() }}

    <input type="text" value="{{ $room->id }}" name="room-id" hidden>
    <input type="text" value="{{ $friend->id }}" name="friend-id" hidden>
    <input class="knop" id="knop" type="submit" value="Invite">
</form>


@endforeach
@component('components/navbar')
@endcomponent

@endsection