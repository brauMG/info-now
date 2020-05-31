<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<?php
use App\User;
use Illuminate\Support\Facades\URL;
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha256-siyOpF/pBWUPgIcQi17TLBkjvNgNQArcmwJB8YvkAgg=" crossorigin="anonymous" />
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
    <link href="{{ asset('bts4/css/datatables.css') }}" rel="stylesheet">
    <link href="{{ asset('bts4/css/sponsors.css') }}" rel="stylesheet">



    {{--Required for TableScrolling--}}
    <link rel="stylesheet" href="https://unpkg.com/simplebar@latest/dist/simplebar.css"/>
    <script src="https://unpkg.com/simplebar@latest/dist/simplebar.min.js"></script>

    {{--Required per Vue.js / Vuetify--}}
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}" defer></script>

    {{--Required for tables--}}
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>--}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>
</head>
    @yield('content')
</html>
