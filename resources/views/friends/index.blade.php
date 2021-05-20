@extends('layouts.app')

@section('title')
    Social
@endsection

@section('content')
<div class="container">
    <a href="/friends/search" class="btn">Zoek Vrienden</a>
    <a href="/friends/list" class="btn">Bekijk vriendenlijst</a> @if($requests)<span style="background-color: #3C7A84; padding: 2px 5px; border-radius: 5px; color: white;">{{ count($requests) }}</span>@endif
    <a href="/leaderboard" class="btn">Bekijk scorebord</a>
</div>

@component('components/navbar')
@endcomponent

@endsection