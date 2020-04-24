<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<?php
use App\User;
use App\MaturityLevel;
?>
<head>
    @yield('head')
    <link rel="icon" href="{{ URL::asset('/css/favicon.ico') }}" type="image/x-icon"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1fd9851a23.js" crossorigin="anonymous"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet">


    <!-- Styles Views-->
    <link href="{{ asset('bts4/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Styles Login-->
    <script src="bts4/js/login.js"></script>
    <link href="{{ asset('bts4/css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('bts4/css/login.less') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>

    <title>Sistema de Evaluación Directiva</title>

</head>
<nav class="navbar navbar-expand-md navbar-light bg-black shadow-sm">
    <div class="container">
        <a class="barText"style="text-transform: uppercase">
            Rapidoss
        </a>
    </div>
</nav>
<body style="background-color: #000000">
@yield('content')
</body>

