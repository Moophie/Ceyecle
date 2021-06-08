@extends('layouts.app')

@section('title')
    Search
@endsection

@section('content')
<h1>Search</h1>
    <form class="search" action="/search" method="GET" role="search">
        <div class="form-group">
            <input class="chatbox" type="text" class="form-control" class="form-control mr-2" name="username" placeholder="Search users" id="username">
        </div>
        <button class="knop" id="knopdrie" class="btn btn-primary" type="submit" title="Search projects">Search</button>
    </form>

<div class="grid">
    @if (isset($search))
        @foreach ($search as $user)
            <div class="evenement">
                @if ($user->profilepic)
                    <img src="{{ asset('images/' . $user->profilepic) }}" class="rounded-circle" style="max-width: 50px;">
                @endif
                <h2 class="card-title">{{ $user->username }}</h2>
                <a href="/add/{{ $user->id }}">Toevoegen</a>
                <a href="/user/{{ $user->id }}">Bekijk profiel</a>
                <!-- @if ($user->age)
                    <p>{{ $user->age }} jaar oud</p>
                @endif
                @if ($user->intrests)
                    <p>Interesses: {{ $user->intrests }}</p>
                @endif -->
            </div>
        @endforeach
    @endif
</div>

@component('components/navbar')
@endcomponent

@endsection