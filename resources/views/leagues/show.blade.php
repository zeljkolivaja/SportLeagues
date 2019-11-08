@extends('layout')

@section('content')


<b>League name</b> : {{$league->leagueName}}
</br>
<b>League description</b> : {{$league->description}}
</br>

<form action="/leagues/{{$league->id}}/edit" method="get">
    @csrf
    <input type="submit" value="Edit League and Teams">
</form>



<form action="/leagues/{{$league->id}}/teams" method="post">
    @csrf
    <input type="text" name="teamName" placeholder='Team Name' required>
    <input type="submit" value="Create Team">
</form>




<b>Table</b>
<br />
<table class="table">
        <thead>
    <tr>
        <th>Name</th>
        <th>GP</th>
        <th>Wins</th>
        <th>Losses</th>
        <th>Draws</th>
        <th>Goals S</th>
        <th>Goals R</th>
        <th>Points</th>
    </tr>
</thead>

<tbody>

    @foreach ($sorted as $team)
    <tr>
        <td>
            {{$team->teamName}}
        </td>
        <td>
            {{$team->totalGamesPlayed}}
        </td>
        <td>
            {{$team->totalWins}}
        </td>
        <td>
            {{$team->totalLosses}}
        </td>
        <td>
            {{$team->totalDraws}}
        </td>
        <td>
            {{$team->totalGoalsScored}}
        </td>
        <td>
            {{$team->totalGoalsConceded}}
        </td>
        <td>
            {{$team->totalPoints}}
    </tr>
    @endforeach
</tbody>

</table>


<br />
Matches:


<div>
    <p class="text-center" id="raspored"> <b>Raspored odigravanja utakmica:</b> </p>
    <hr>
</div>
<br />

<div class="container">
<div class="row">


@if(isset($schedule))
@foreach($schedule as $round => $games)
<div class="col-4">

    <b> Kolo: {{$round+1}} <BR> </b>

    @foreach($games as $team)
    @if($team["Home"]=="slobodan" or $team["Away"]=="slobodan")

    @if($team["Home"]!=="slobodan")

    <b>{{$team["Home"]}} preskace ovo kolo</b> <BR>
    @endif


    @if($team["Away"]!=="slobodan")

    <b> {{ $team["Away"]}} preskace ovo kolo</b> <BR>
    @endif


    @continue;
    @endif

    {{ $team["Home"]}} vs {{$team["Away"]}} <BR>




    @endforeach
    <br>
</div>


@endforeach

</div>
</div>


{{-- <div id="remote"></div> --}}



@foreach($schedule as $round => $games)
<div class="cell large-3 small-6">

    <b> Kolo: {{$round+1}} <BR> </b>

    @foreach($games as $team)

    @if($team["Home"] == "slobodan" or $team["Away"] == "slobodan")
    @continue
    @endif

    <form action="/games" method="post" class="gamesForm">

        <input type=text name="homeTeam" readonly id="" value="{{$team["Home"]}}">
        vs
        <input type=text name="awayTeam" readonly id="" value="{{$team["Away"]}}">
        <input type="number" name="homeTeamGoals" value="0">
        <input type="number" name="awayTeamGoals" id="" value="0">
        <input type="hidden" name="league" value="{{$league->id}}" readonly />
        <input type="submit" value="SUBMIT RESULT">
    </form>


    @endforeach
    <br>
</div>

@endforeach
@endif







@if (session('message'))
<p> {{ session('message')}} </p>
@endif


@if ($errors->any())

@foreach ($errors->all() as $error)
{{ $error }}

@endforeach
@endif


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
    $('.gamesForm').on('submit',function(e){
    var form = $(this);
    var submit = form.find("[type=submit]");
    var submitOriginalText = submit.attr("value");

    e.preventDefault();
    var data = form.serialize();
    var url = form.attr('action');
    var post = form.attr('method');
    $.ajax({
        type : post,
        url : url,
        data :data,
        success:function(data){
           submit.attr("value", "Submitted");
           if (data=="2") {
            alert("The game has already been submited, to enter result again delete it");
            }
        // document.getElementById("remote").innerHTML = data;




          },
        beforeSend: function(){
           submit.attr("value", "Loading...");
           submit.prop("disabled", true);
        },
        error: function() {
            submit.attr("value", submitOriginalText);
            submit.prop("disabled", false);
           // show error to end user
        }
    })
})
</script>


@endsection
