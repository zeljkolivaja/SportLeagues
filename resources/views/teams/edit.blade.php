
@if (session('message'))
<p> {{ session('message')}} </p>
@endif

<form action="/teams/{{$team->id}}" method="post">
{{ method_field("PATCH") }}
@csrf
<input type="text" name="teamName" value='{{$team->teamName}}' required>
<input type="submit" value="Edit Team">
</form>