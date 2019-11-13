@extends('layout')

@section('content')
<br />

@if (session('message'))
<p> {{ session('message')}} </p>
@endif


<form class="form-inline" action="/teams/{{$team->id}}" method="post">
    {{ method_field("PATCH") }}
    @csrf
    <label class="sr-only" for="inlineFormInputName2">Name</label>
    <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" name="teamName"
        value='{{$team->teamName}}' required">

    <button type="submit" class="btn btn-primary mb-2">Submit</button>
</form>


@endsection
