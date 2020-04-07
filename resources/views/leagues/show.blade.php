@extends('layout')
@section('content')

<br />

<div class="row">
    <div class="col-12 d-flex justify-content-center">
        <h1> {{$league->leagueName}} </h1>
    </div>

    <div class="col-12 d-flex justify-content-center">
        <h4>CONTROL PANEL</h4>
    </div>
</div>

@include('leagues.controlPanel')

<br />

<div class="row">
    <div class="col-md-12 text-center">
        <form action="/leagues/{{$league->id}}/teams" method="post">
            @csrf
            <input type="text" name="teamName" placeholder='Team Name' required>
            <input class="btn btn-primary" type="submit" value="Create Team">
        </form>
    </div>
</div>

<br />

TABLE
@include('leagues.table')

<br />

<div>
    <p class="text-center" id="raspored"> <b>SCHEDULE:</b> </p>
    <hr>
</div>

@include('leagues.scheduleAndInsertResults')
@endsection