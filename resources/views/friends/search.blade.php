@extends('layouts.app')

@section('title')
    Search
@endsection

@section('content')
    <form action="/search" method="GET" role="search">
        <div class="form-group">
            <label for="username">Search</label>
            <input type="text" class="form-control" class="form-control mr-2" name="username" placeholder="Search users" id="username">
        </div>
        <button class="btn btn-primary" type="submit" title="Search projects">Search</button>
    </form>

<div class="grid">
    @if (isset($search))
        @foreach ($search as $user)
            <div class="card" style="width:300px">
                @if ($user->profilepic)
                    <img src="{{ asset('images/' . $user->profilepic) }}" class="card-img-top">
                @endif
                <div class="card-body">
                    <h2 class="card-title">{{ $user->username }}</h2>
                    @if ($user->age)
                        <p>{{ $user->age }} jaar oud</p>
                    @endif
                    @if ($user->intrests)
                        <p>Interesses: {{ $user->intrests }}</p>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
</div>

@component('components/navbar')
@endcomponent

@endsection