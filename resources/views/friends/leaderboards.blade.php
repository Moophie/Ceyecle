@extends('layouts.app')

@section('title')
    Leaderboard
@endsection

@section('content')

    @php
        $user = Auth::user();
        array_push($friends, $user);
        usort($friends, function($a, $b) {
                        return $a->score < $b->score ? 1 : -1;
                    });
    @endphp

    @for($i = 0; $i < count($friends); $i++)
        <div>
            <span>{{ $i+1 }}</span>
            <p>{{ $friends[$i]['username'] }}</p>
            <p>{{ $friends[$i]['score'] }}</p>
        </div>
    @endfor

@component('components/navbar')
@endcomponent

@endsection