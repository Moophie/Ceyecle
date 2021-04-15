@extends('layouts.app')

@section('title')
    Social
@endsection

@section('content')
<div class="container">
    <a href="/friends/search" class="btn">Zoek Vrienden</a>
    <a href="/friends/list" class="btn">Bekijk vriendenlijst</a>
    <a href="/leaderboard" class="btn">Bekijk scorebord</a>
</div>

@component('components/navbar')
@endcomponent

@endsection