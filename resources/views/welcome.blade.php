<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/front.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="parallax flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    #Bibz
                </div>
                    <div id="countdown"></div>
            </div>
        </div>
        <div class="grid-container">
            <div class="row">
                <div class="col-6">
                    <h1>Team</h1>
                    <hr />
                </div>
            </div>
            <div class="row">
                <div class="col-1">
                    <div class="card">
                        <div class="container">
                            <img src="{{ asset('img/pandora/Sven.jpg') }}" alt="Sven" style="width:100%">
                            <h2>CEO - Sven</h2>
                        </div>
                    </div>
                </div>

                <div class="col-1">
                    <div class="card">
                        <div class="container">
                            <img src="{{ asset('img/pandora/Olaf.png') }}" alt="Olaf" style="width:100%">
                            <h2>Olaf</h2>
                        </div>
                    </div>
                </div>

                <div class="col-1">
                    <div class="card">
                        <div class="container">
                            <img src="{{ asset('img/pandora/Elsa.png') }}" alt="Elsa" style="width:100%">
                            <h2>Elsa</h2>
                        </div>
                    </div>
                </div>
                <div class="col-1">
                    <div class="card">
                        <div class="container">
                            <img src="{{ asset('img/pandora/Anna.png') }}" alt="Anna" style="width:100%">
                            <h2>Anna</h2>
                        </div>
                    </div>
                </div>
                <div class="col-1">
                    <div class="card">
                        <div class="container">
                            <img src="{{ asset('img/pandora/Kristoff.png') }}" alt="Kristoff" style="width:100%">
                            <h2>Kristoff</h2>
                        </div>
                    </div>
                </div>
                <div class="col-1">
                    <div class="card">
                        <div class="container">
                            <img src="{{ asset('img/pandora/Baymax.png') }}" alt="Baymax" style="width:100%">
                            <h2>Baymax</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <hr />
                </div>
            </div>
        </div>
        <!-- JavaScripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
        <script src="{{ asset('js/front.js') }}" type="text/JavaScript"></script>
    </body>
</html>
