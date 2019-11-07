@extends('layout')


@section('content')

@foreach ($leagues as $league)
<li>


<a href="/leagues/{{$league->id}}">
         {{$league->leagueName}} </a>
        <br/>
        </li>


@endforeach







@if (session('message'))
<p> {{ session('message')}} </p>
@endif

@endsection
