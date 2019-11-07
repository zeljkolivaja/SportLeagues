@extends('layout')


@section('content')

@if (session('message'))
<p> {{ session('message')}} </p>
@endif


<form action="/leagues/{{$league->id}}" method="post">
@csrf
{{ method_field("PATCH") }}

<input type="text" name="leagueName" id="" value='{{$league->leagueName}}' >
<input type="text" name="description" id="" value='{{$league->description}}'>
<input type="submit" value="Edit League">

 </form>



 <form method="post" action="/leagues/{{ $league->id }}" >
@csrf
{{ method_field("delete") }}

 <input type="submit" value="Delete League"></form>


 @foreach ($league->teams as $team)

 {{$team->teamName}} .
 <form method="post" action="/teams/{{ $team->id }}" >
    @csrf
    {{ method_field("delete") }}

 <input type="submit" value="Delete Team"></form>
 <form method="get" action="/teams/{{ $team->id }}/edit" >
 @csrf
<input type="submit" value="Edit Team"></form>

 @endforeach

 @endsection
