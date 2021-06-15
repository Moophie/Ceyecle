@extends('layouts/app')

@section('title')
    Profile settings
@endsection

@section('content')
<a href=""><img class="terug" src="{{ asset('/images/pijltje.png') }}" alt=""></a>
<h1>{{ Auth::user()->username }}</h1>
<p class="me">Hier maak je aanpassingen aan je profiel!</p>

<div class="aanpassing">
    <form  id="from" class="form-group" action="./update" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <label class="titel" for="image">Profile picture</label><br>
        <input type="file" name="image" id="image">

        <label  class="titel" for="intrests">Interesses</label>
        <input class="form-control" type="text" name="intrests" id="intrests" value="{{ Auth::user()->intrests }}">

        <label class="titel" for="age">Leeftijd</label>
        <input class="form-control" type="number" name="age" id="age" value="{{ Auth::user()->age }}">
            
        <input class="bevestig" type="submit" class="btn btn-primary" value="Save">
    </form>
</div>

<div class="kader">
<h2>Deelgenomen aan</h2>
    <img src="https://via.placeholder.com/100" alt="Race picture">
    <h2>WK Veldrijden 2021</h2>
    <p class="me">30-31/01/2021</p>
    <a href="">Meer info</a>
</div>

@component('components/navbar')
@endcomponent

@endsection