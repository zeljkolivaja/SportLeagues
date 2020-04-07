@extends('layout')


@section('content')

@if (session('message'))
<p> {{ session('message')}} </p>
@endif

 <br/>
 <form action="/leagues/{{$league->id}}" method="post">
   @csrf
   {{ method_field("PATCH") }}

   <div class="form-group">

     <label for="leagueName">League name</label>
     <input type="text" name="leagueName" value='{{$league->leagueName}}' class="form-control" aria-describedby="leagueName">
    </div>


    <div class="form-group">
      <label for="exampleFormControlTextarea1">League description</label>
      <textarea class="form-control" name="description" rows="3">{{$league->description}}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
 </form>
 


<br/>

<form method="post" action="/leagues/{{ $league->id }}" >
@csrf
{{ method_field("delete") }}

 <input type="submit" class="btn btn-danger" value="Delete League">
</form>

<br/>

<div class='row'>

   <div class='col-12'><h2> Menage your team data </h2> </div>

 @foreach ($league->teams as $team)

 <div class='col-4'>

   <div class="card">
      <div class="card-header">
         Team name : {{$team->teamName}}
      </div>
      <div class="card-body">
 

         <form method="get" action="/teams/{{ $team->id }}/edit" >
         @csrf
        <input type="submit" class="btn btn-primary" value="Edit Team">
        </form>
        <br/>
        
        <form method="post" action="/teams/{{ $team->id }}" >
         @csrf
         {{ method_field("delete") }}

 
      <input type="submit" class='btn btn-danger' value="Delete Team">
   </form>

      </div>
    </div>

   
<br/>
</div>

 @endforeach
 </div>

 @endsection
