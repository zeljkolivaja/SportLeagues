@extends('layout')

@section('content')




<div class="container">
    <div class="row">


     @foreach($games as $item)
    <div class="col-4">






        {{ $item->homeTeamName}} vs {{ $item->awayTeamName}} <BR>
        {{ $item->homeTeamGoals}} vs {{ $item->awayTeamGoals}}


        <form method="post" action="/games/{{ $item->id }}" >
            @csrf
            {{ method_field("delete") }}




             <input type="submit" value="Delete Game"></form>







    </div>


    @endforeach

    </div>
    </div>


    @endsection
