@extends('layouts.app')

@section('title')
    Social
@endsection

@section('content')
<div class="container">
    <a class="knop" id="knopone" href="/friends/search" class="btn">Zoek Vrienden</a>
    <a class="knop" id="knopone" href="/friends/list" class="btn">Bekijk vriendenlijst</a> @if($requests)<span style="background-color: #3C7A84; padding: 2px 5px; border-radius: 5px; color: white;">{{ count($requests) }}</span>@endif
    <a class="knop" id="knopone" href="/leaderboard" class="btn">Bekijk scorebord</a>
    <a class="knop" id="knopone" href="/chat" class="btn">Chat</a>
</div>

@component('components/navbar')
@endcomponent

@endsection