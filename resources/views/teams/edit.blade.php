@extends('layout')

@section('content')
<br />

@if (session('message'))
<p> {{ session('message')}} </p>
@endif


<form action="/teams/{{$team->id}}" method="post">
    {{ method_field("PATCH") }}
    @csrf
    <div class="form-group">
      <label for="teamName">Edit team name</label>
      <input type="text" class="form-control" name="teamName" value='{{$team->teamName}}' required>
     </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  


@endsection
