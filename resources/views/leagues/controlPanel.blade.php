<div class="col-md-12 text-center">

    <div class="btn-group" role="group" aria-label="Basic example">
  
      <form action="/leagues/{{$league->id}}/edit" method="get">
          @csrf
          <input class="btn btn-dark" type="submit" value="Edit League and Teams">
      </form>
  
      <form action="/games" method="get">
          @csrf
          <input type="text" class="hide" name="league" value="{{$league->id}}" readonly />
          <input class="btn btn-dark" type="submit" value="Menage Games">
      </form>
  
      <form action="/leagueReset" method="post">
          @csrf
          <input type=text class="hide" name="league" readonly value="{{$league->id}}">
          <input class="btn btn-dark" type="submit" value="Reset League">
      </form>
  
      <form method="post" action="/leagues/{{$league->id}}">
          @csrf
          {{ method_field("delete") }}
          <input class="btn btn-danger " type="submit" value="Delete League">
      </form>
   
  </div>
  </div>
  