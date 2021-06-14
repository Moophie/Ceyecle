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


    <img class="sparkel" src="{{ asset('/images/sparkel.png') }}" alt="">
    <div class="topdrie">
    @if(count($friends) >= 3)
        @for($i = 0; $i < 3; $i++)
            <div class="podium">
                <img class="profilepic"  src="{{ $friends[$i]['profilepic'] }}" alt="{{ $friends[$i]['username'] }}">
                <h4>{{ $friends[$i]['username'] }}</h4>
            </div>
        @endfor
    @else
        @for($i = 0; $i < count($friends); $i++)
            <div class="podium">
                <img class="profilepic"  src="{{ $friends[$i]['profilepic'] }}" alt="{{ $friends[$i]['username'] }}">
                <p>{{ $friends[$i]['username'] }}</p>
            </div>
        @endfor
    @endif
    </div> 
    
                  
    <h2>Beste quizer</h2>
    @for($i = 0; $i < count($friends); $i++)
        <div class="flex">
            <span>{{ $i+1 }}</span>
            <img class="profilepic"  src="{{ $friends[$i]['profilepic'] }}" alt="{{ $friends[$i]['username'] }}">
            <p>{{ $friends[$i]['username'] }}</p>
            <p>{{ $friends[$i]['score'] }}p</p>
        </div>
    @endfor

@component('components/navbar')
@endcomponent

@endsection