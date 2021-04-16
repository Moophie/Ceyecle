@extends('layouts.app')

@section('title')
    Vriendenlijst
@endsection

@section('content')
    @foreach($friends as $friend)
        <div>
            <h2>{{ $friend->username }}</h2>
        </div>
    @endforeach

    @component('components/navbar')
    @endcomponent

@endsection