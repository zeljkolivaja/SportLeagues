@extends('layout')


@section('content')


<form action="/leagues" method="post">
@csrf
<input type="text" name="leagueName" id="" placeholder='League Name'>
<input type="text" name="description" id="" placeholder='League description'>
<input type="submit" value="Create League">

</form>


@endsection
