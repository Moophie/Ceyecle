@extends('layouts.app')

@section('title')
    Leaderboard
@endsection
@section('content')
    <a href="{{ url()->previous() }}"><img class="terug" src="{{ asset('/images/links.png') }}" alt=""></a>
    <img class="achtergrond" src="{{ asset('/images/grond.png') }}" alt="">

    @php
    $user = Auth::user();
    array_push($friends, $user);
    usort($friends, function ($a, $b) {
        return $a->score < $b->score ? 1 : -1;
    });
    @endphp

    <!--<img class="sparkel" src="{{ asset('/images/sparkel.png') }}" alt="">-->
    <div class="topdrie">
        @if (count($friends) >= 3)
            @for ($i = 0; $i < 3; $i++)
                <div class="podium">
                    <img class="profilepicie" src="{{ $friends[$i]['profilepic'] }}"
                        alt="{{ $friends[$i]['username'] }}">
                    <h4>{{ $friends[$i]['username'] }}</h4>
                </div>
            @endfor
        @else
            @for ($i = 0; $i < count($friends); $i++)
                <div class="podium">
                    <img class="profilepicie" src="{{ $friends[$i]['profilepic'] }}"
                        alt="{{ $friends[$i]['username'] }}">
                    <p>{{ $friends[$i]['username'] }}</p>
                </div>
            @endfor
        @endif
    </div>


    <h2 class="quizer">Beste quizer</h2>
    <div class="klassement">
        @for ($i = 0; $i < count($friends); $i++)
            <div class="flex">
                <span class="span">{{ $i + 1 }}</span>
                <img class="profilepiciee" src="{{ $friends[$i]['profilepic'] }}"
                    alt="{{ $friends[$i]['username'] }}">
                <p class="naam">{{ $friends[$i]['username'] }}</p>
                <p class="punt">{{ $friends[$i]['score'] }}p</p>
            </div>
        @endfor
    </div>

    @component('components/navbar')
    @endcomponent

@endsection
</div>
