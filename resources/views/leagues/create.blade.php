@extends('layout')


@section('content')
<br/>
 <form class="form-inline" action="/leagues" method="post">
    @csrf
    <div class="form-group mb-2">
        <label for="inputPassword2" class="sr-only">Insert League Name</label>
        <input type="text" name="leagueName" class="form-control" id="inputPassword2" placeholder="League Name">
    </div>

    <div class="form-group mx-sm-3 mb-2">
        <label for="inputPassword2" class="sr-only">Insert League description</label>
        <input type="text" name="description" class="form-control" id="inputPassword2" placeholder="League description">
    </div>
    <button type="submit" class="btn btn-primary mb-2">Save New League</button>
</form>



@endsection
