This game already exists
<br>

 {{$match[0]->home}} vs  {{$match[0]->away}}
 <br>
 {{$match[0]->homeTeamGoals}} :  {{$match[0]->awayTeamGoals}}


 <form method="post" action="/games/{{ $match[0]->id }}" >
    @csrf
    {{ method_field("delete") }}




     <input type="submit" value="Delete Game"></form>


