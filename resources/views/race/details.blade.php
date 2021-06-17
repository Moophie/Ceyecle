@extends('layouts/app')
@section('title')

@endsection

@section('content')
    <a href="{{ url()->previous() }}"><img class="terug" src="{{ asset('/images/pijltje.png') }}" alt=""></a>
    <h1>{{ $race->name }}</h1>
    <img class="race" src="{{ asset('/storage/cycling/races/' . $race->event_map_picture) }}" alt="Event image"
        height="150px">
    <p class="me">{{ $race->startdate }} - {{ $race->enddate }}</p>
    <h2>Fases</h2>
    @foreach ($race->stages as $stage)
        <h3>{{ $stage->name }}</h3>
        <p class="me">{{ $stage->date }}</p>
        <p class="me">{{ $stage->departure }} - {{ $stage->arrival }}</p>
        <p class="me">{{ $stage->distance }} kilometers op {{ $stage->type }} terrein</p>
        <img src="{{ asset('/storage/cycling/stages/' . $stage->profile_img) }}" alt="Stage image" height="50px">
    @endforeach


    @component('components/navbar')
    @endcomponent

@endsection()
