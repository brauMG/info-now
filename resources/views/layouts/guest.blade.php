<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<?php
use App\User;
?>
<head>
    @yield('head')
    <link rel="icon" href="{{ URL::asset('/css/favicon.ico') }}" type="image/x-icon"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sistema de Enfoque Rapido</title>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="{{ asset('js/customer.js') }}" defer></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1fd9851a23.js" crossorigin="anonymous"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>

    {{--Required for Charts--}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>

    <!-- Styles -->
    <link href="{{ asset('bts4/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('bts4/css/layout.css') }}" rel="stylesheet">

    {{--Required for TableScrolling--}}
    <link rel="stylesheet" href="https://unpkg.com/simplebar@latest/dist/simplebar.css"/>
    <script src="https://unpkg.com/simplebar@latest/dist/simplebar.min.js"></script>

    {{--Required per Vue.js / Vuetify--}}
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}" defer></script>

    {{--Background--}}
    <script src="bts4/js/login.js"></script>
    <link href="{{ asset('bts4/css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('bts4/css/login.less') }}" rel="stylesheet">
    <link href="{{ asset('bts4/css/recovery.css') }}" rel="stylesheet">

</head>

<nav class="navbar-ica bg-ica shadow-sm forward">
        <a class="navbar-brand ml-auto" href="{{ url('/login') }}">
            <h6>Volver al Inicio</h6>
        </a>
</nav>
<body style="background-color: #000000">
@yield('content')
</body>
