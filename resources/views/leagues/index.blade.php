@extends('layout')


@section('content')

{{-- @foreach ($leagues as $league)
<li>


    <a href="/leagues/{{$league->id}}">
        {{$league->leagueName}} </a>
    <br />
</li>


@endforeach --}}

<br/>
<div class="row">

@foreach ($leagues as $league)

        <div class="col-sm-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{$league->leagueName}}</h5>
              <p class="card-text">{{$league->description}}</p>
              <a href="/leagues/{{$league->id}}" class="btn btn-primary">Menage League</a>
            </div>
          </div>
        </div>




 @endforeach
</div>




@if (session('message'))
<p> {{ session('message')}} </p>
@endif

@endsection
