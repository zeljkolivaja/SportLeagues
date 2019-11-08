<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sports League</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

</head>

<body>
    <div class="container">

        <div class="page-header">
            <h1>Sports Leagues</h1>
        </div>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>


                    @if(Auth::user())
                    <a class="nav-item nav-link" href="/leagues">Your Leagues</a>
                    <a class="nav-item nav-link" href="/leagues/create">Create new League</a>
                    <a class="nav-item nav-link" href="/logout">Logout</a>
                    @else
                    <a class="nav-item nav-link" href="/login">Login</a>
                    <a class="nav-item nav-link" href="/register">Register</a>

                    @endif


                </div>
            </div>
    </div>
    </nav>
    <div>




        <div class="container">

            @yield('content')

        </div>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="{{ asset('js/bootstrap.js') }}"></script>



</body>

</html>
