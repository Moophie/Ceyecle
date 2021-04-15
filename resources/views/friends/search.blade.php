@extends('layouts.app')

@section('title')
    Search
@endsection

@section('content')
    <form action="/search" method="GET" role="search">
        <input type="text" class="form-control mr-2" name="username" placeholder="Search users" id="username">
        <button class="btn btn-info" type="submit" title="Search projects">Search</button>
    </form>

    @if (isset($search))
        @foreach ($search as $user)
            <div>
                {{ $user->username }}
            </div>
        @endforeach
    @endif

@component('components/navbar')
@endcomponent

@endsection