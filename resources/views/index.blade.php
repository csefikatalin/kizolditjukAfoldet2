<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->


    <link rel="stylesheet" href="../css/index.css">
    <meta name="csrf-token" content=<?php $token = csrf_token();
                                    echo $token; ?>>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="../js/ajax.js"></script>
    <script src="../js/index.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
    <div id="container">
        <header class="">
            <h1>Kizöldítjük a Földet!</h1>

            <div id="bejelentkezes">
                @if (Route::has('login'))
                <div class="hidden ">
                    @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                    @else
                    <a href="{{ route('login') }}">Log in</a>

                    @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                    @endif
                    @endauth
                </div>
                @endif
            </div>
        </header>

        <div>


            <section id="urlap">
                <form>
                    <fieldset>
                        <legend> Mit tettél ma a Földért? </legend>
                        <select id="osztalyok">
                            <option value="0" selected>Válassz osztályt!</option>
                        </select>
                        <select id="tevekenysegek">
                            <option value="0" selected>Válassz tevékenységet!</option>
                        </select>
                        <input type="button" id="kuld" value="Küld">
                    </fieldset>
                </form>
            </section>
            <section id="diagram">

            </section>
            <section id="adatok">
                <div class=" fejlec">
                    <div class="osztaly">Osztály</div>
                    <div class="tevekenyseg">Tevékenység</div>
                    <div class="pontszam">Pont</div>
                    <div class="allapot">Státusz</div>
                </div>

            </section>


        </div>
    </div>
</body>

</html>
