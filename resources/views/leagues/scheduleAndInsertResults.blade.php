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
    
     </p>
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
<p class="text-center"><a href="<?php $_SERVER['PHP_SELF']; ?>" class='btn btn- btn-success'>Click to update table with new results</a>






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
