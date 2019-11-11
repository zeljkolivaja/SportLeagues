@extends('layout')

@section('content')

<br />

<div class="row">

    <div class="col-12 d-flex justify-content-center">
        <b>League</b> : {{$league->leagueName}}
    </div>

    <div class="col-12 d-flex justify-content-center">
        <h2>CONTROL PANEL</h2>
    </div>
</div>

<div class="row">

    <div class="col-12 d-flex justify-content-center custom">
        <form action="/leagues/{{$league->id}}/edit" method="get">
            @csrf
            <input class="btn btn-primary " type="submit" value="Edit League and Teams">
        </form>
    </div>

    <div class="col-12 d-flex justify-content-center custom">
        <form action="/games" method="get">
            @csrf
            <input type="hidden" name="league" value="{{$league->id}}" readonly />
            <input class="btn btn-primary " type="submit" value="Menage Games">
        </form>
    </div>

    <div class="col-12 d-flex justify-content-center custom">
        <form action="/leagueReset" method="post">
            @csrf
            <input type=text name="league" readonly value="{{$league->id}}" hidden>
            <input class="btn btn-primary" type="submit" value="Reset League">
        </form>
    </div>

    <div class="col-12 d-flex justify-content-center custom">
        <form method="post" action="/leagues/{{$league->id}}">
            @csrf
            {{ method_field("delete") }}
            <input class="btn btn-danger " type="submit" value="Delete League">
        </form>
    </div>

    <div class="col-12 d-flex justify-content-center">

        <form action="/leagues/{{$league->id}}/teams" method="post">
            @csrf
            <input type="text" name="teamName" placeholder='Team Name' required>
            <input class="btn btn-primary" type="submit" value="Create Team">
        </form>
    </div>
</div>


<br />

{{-- table row --}}
<div class="row d-flex justify-content-center">
    <div class="col-sm-10 col-xl-12">
        <br />
        <h4>Table</h4>
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 7%">Name</th>
                    <th scope="col" class="d-none d-sm-table-cell" style="width: 4%">GP</th>
                    <th style="width: 4%">Wins</th>
                    <th style="width: 4%">Losses</th>
                    <th style="width: 4%">Draws</th>
                    <th scope="col" class="d-none d-sm-table-cell" style="width: 4%">Goals S</th>
                    <th scope="col" class="d-none d-sm-table-cell" style="width: 4%">Goals R</th>
                    <th style="width: 4%">Points</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($sorted as $team)
                <tr>
                    <td>
                        {{$team->teamName}}
                    </td>
                    <td scope="col" class="d-none d-sm-table-cell">
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
                    <td scope="col" class="d-none d-sm-table-cell">
                        {{$team->totalGoalsScored}}
                    </td>
                    <td scope="col" class="d-none d-sm-table-cell">
                        {{$team->totalGoalsConceded}}
                    </td>
                    <td>
                        {{$team->totalPoints}}
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

<br />


<div>
    <p class="text-center" id="raspored"> <b>SCHEDULE:</b> </p>
    <hr>
</div>


<div class="row">


    @if(isset($schedule))
    @foreach($schedule as $round => $games)
    <div class="col-lg-3 col-md-6">

        <b> Round: {{$round+1}} <BR> </b>

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

<div>
    <p class="text-center"> <b>ENTER GAME RESULTS:</b> </p>
    <hr>
</div>


<div class="row">
    @foreach($schedule as $round => $games)
    <div class="cell large-3 small-6">

        <b> Round: {{$round+1}} <BR> </b>

        @foreach($games as $team)
        @if($team["Home"] == "slobodan" or $team["Away"] == "slobodan")
        @continue
        @endif

        {{-- <form action="/games" method="post" class="gamesForm">

        <input type=text name="homeTeam" readonly id="" value="{{$team["Home"]}}">
        vs
        <input type=text name="awayTeam" readonly id="" value="{{$team["Away"]}}">
        <input type="number" name="homeTeamGoals"
            value="{{\App\Game::where('awayTeamName',$team["Away"])->where('homeTeamName',$team["Home"])->value('homeTeamGoals')}}">
        <input type="number" name="awayTeamGoals" id=""
            value="{{\App\Game::where('awayTeamName',$team["Away"])->where('homeTeamName',$team["Home"])->value('awayTeamGoals')}}">
        <input type="hidden" name="league" value="{{$league->id}}" readonly />
        <input type="submit" value="SUBMIT RESULT">

        </form> --}}

        <div class="col-12 ">

            <form class="form-inline gamesForm" action="/games" method="post">

                <div class="form-group mb-2 ">
                    <input type="text" name="homeTeam" readonly class="form-control-plaintext"
                        value="{{$team["Home"]}}">
                </div>


                <div class="input-group mb-2 mr-sm-2">
                    <label for="staticEmail2" class="sr-only">Away Team</label>
                    <input type="text" name="awayTeam" readonly class="form-control-plaintext"
                        value="{{$team["Away"]}}">
                </div>

                <div class="input-group mb-2 mr-sm-2">
                    <label for="inputPassword2" class="sr-only">Password</label>
                    <input type="number" min="0" max="150" name="homeTeamGoals" class="form-control"
                        value="{{\App\Game::where('awayTeamName',$team["Away"])->where('homeTeamName',$team["Home"])->value('homeTeamGoals')}}">
                </div>

                <div class="input-group mb-2 mr-sm-2">
                    <label for="inputPassword2" class="sr-only">Password</label>
                    <input type="number" min="0" max="150" name="awayTeamGoals" class="form-control"
                        value="{{\App\Game::where('awayTeamName',$team["Away"])->where('homeTeamName',$team["Home"])->value('awayTeamGoals')}}">
                </div>

                <div class="input-group mb-2 mr-sm-2">
                    <input type="text" name="league" hidden readonly value="{{$league->id}}">
                </div>

                <button type="submit" class="btn btn-primary mb-2">Submit Result</button>
            </form>
        </div>

        @endforeach

        <br>
    </div>

    @endforeach
    @endif

</div>





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
        //    submit.attr("value", "Submitted");
           if (data=="2") {
            alert("The game has already been submited, to enter result again delete it");
            }
        // document.getElementById("remote").innerHTML = data;




          },
        // beforeSend: function(){
        //    submit.attr("value", "Loading...");
        //    submit.prop("disabled", true);
        // },
        // error: function() {
        //     submit.attr("value", submitOriginalText);
        //     submit.prop("disabled", false);
        //    // show error to end user
        // }
    })
})
</script>


@endsection
