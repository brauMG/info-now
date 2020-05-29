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

<div class="navbar-ica bg-ica">
    @if(Auth::user()->Clave_Rol=='1')
        <a class="navbar-brand ml-auto nav-name">
            <i class="fas fa-user-tie"></i>
            <h6 class="h6-less"><strong>Super Administrador de <strong style="color: #0e84b5" onclick="ChangeCompany();">@yield('company','Sin Compañia')</strong>, {{ Auth::user()->Nombres }}</strong></h6>
        </a>

        <a class="navbar-brand ml-auto nav-name">
            <div class="logout-button" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="text-align: right">
                <i class="fas fa-sign-out-alt"></i>
                <h6 class="h6-less"><strong>Salir</strong></h6>
            </div>
        </a>
    @elseif (Auth::user()->Clave_Rol=='2')
        <a class="navbar-brand ml-auto nav-name">
            <i class="fas fa-user-tie"></i>
            <h6 class="h6-less"><strong>Administrador de @yield('company','Sin Compañia'), {{ Auth::user()->Nombres }}</strong></h6>
        </a>
        <a class="navbar-brand ml-auto nav-name">
            <div class="logout-button" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="text-align: right">
                <i class="fas fa-sign-out-alt"></i>
                <h6 class="h6-less"><strong>Salir</strong></h6>
            </div>
        </a>
    @elseif (Auth::user()->Clave_Rol=='3')
        <a class="navbar-brand ml-auto nav-name">
            <i class="fas fa-user-tie"></i>
            <h6 class="h6-less"><strong>Usuario de @yield('company','Sin Compañia'), {{ Auth::user()->Nombres }}</strong></h6>
        </a>
        <a class="navbar-brand ml-auto nav-name">
            <div class="logout-button" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="text-align: right">
                <i class="fas fa-sign-out-alt"></i>
                <h6 class="h6-less"><strong>Salir</strong></h6>
            </div>
        </a>
    @elseif (Auth::user()->Clave_Rol=='4')
        <a class="navbar-brand ml-auto nav-name">
            <i class="fas fa-user-tie"></i>
            <h6 class="h6-less"><strong>PMO de @yield('company','Sin Compañia'), {{ Auth::user()->Nombres }}</strong></h6>
        </a>
        <a class="navbar-brand ml-auto nav-name">
            <div class="logout-button" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="text-align: right">
                <i class="fas fa-sign-out-alt"></i>
                <h6 class="h6-less"><strong>Salir</strong></h6>
            </div>
        </a>
    @endif
</div>

<div class="sidebar">
    @auth
        <form id="logout-form" action="{{ route('logout') }}" method="POST"
              style="display: none;">
            @csrf
        </form>
            @if(Auth::user()->Clave_Rol==2 || Auth::user()->Clave_Rol==4)
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-1 text-cool" style="margin-top: 0% !important;">
                <span><strong>Reportes </strong></span>
            </h6>
            <a class="side-font sidebar-margin-elements" href="{{route('FiltersActivities')}}" style="padding-top: 2% !important; padding-bottom: 2% !important;"><i class="fas fa-file-excel"></i> De Actividades </a>
            <a class="side-font sidebar-margin-elements" href="{{route('FiltersStages')}}" style="padding-top: 2% !important; padding-bottom: 2% !important;"><i class="fas fa-file-excel"></i> De Etapas </a>
            <a class="side-font sidebar-margin-elements" href="{{route('FiltersProjects')}}" style="padding-top: 2% !important; padding-bottom: 2% !important;"><i class="fas fa-file-excel"></i> De Proyectos </a>
            <a class="side-font sidebar-margin-elements" href="{{route('FiltersUsers')}}" style="padding-top: 2% !important; padding-bottom: 2% !important;"><i class="fas fa-file-excel"></i> De Usuarios </a>
            <a class="side-font sidebar-margin-elements" href="{{route('FiltersUsersProjects')}}" style="padding-top: 2% !important; padding-bottom: 2% !important;"><i class="fas fa-file-excel"></i> De Usuarios en Proyectos </a>
            @endif
            @if(Auth::user()->Clave_Rol==2 || Auth::user()->Clave_Rol==4)
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-1 text-cool" style="margin-top: 0% !important;">
                    <span><strong>Gráficas </strong></span>
                </h6>
            @endif
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-1 text-cool">
        <span>
            <strong>
                @if(Auth::user()->Clave_Rol==1)
                    {{'Super Administrador'}}
                @endif
                @if(Auth::user()->Clave_Rol==2)
                    {{'Administrador'}}
                @endif
                @if(Auth::user()->Clave_Rol==3)
                    {{'Usuario'}}
                @endif
                @if(Auth::user()->Clave_Rol==4)
                    {{'PMO'}}
                @endif
            </strong>
        </span>
        </h6>
        <!-- ROUTES -->
        @if(Auth::user()->Clave_Rol==1)
            <a class="side-font sidebar-margin-elements @if(request()->path() == 'Admin/Compania')){ active } @else {} @endif" href="{{ url('/Admin/Compania') }}"><i class="fas fa-registered"></i> Compañias</a>
        @endif

        @if(Auth::user()->Clave_Rol==1)
            <a class="side-font sidebar-margin-elements @if(request()->path() == 'Admin/Roles')){ active } @else {} @endif" href="{{ url('/Admin/Roles') }}"><i class="fas fa-user-tag"></i> Roles</a>
        @endif

        @if(Auth::user()->Clave_Rol==1||Auth::user()->Clave_Rol==2)
            <a class="side-font sidebar-margin-elements @if(request()->path() == 'Admin/Areas')){ active } @else {} @endif" href="{{ url('/Admin/Areas') }}"><i class="fas fa-project-diagram"></i> Áreas</a>
        @endif

        @if(Auth::user()->Clave_Rol==1||Auth::user()->Clave_Rol==2)
            <a class="side-font sidebar-margin-elements @if(request()->path() == 'Admin/Puestos')){ active } @else {} @endif" href="{{ url('/Admin/Puestos') }}"><i class="fas fa-users-cog"></i> Puestos</a>
        @endif

        @if(Auth::user()->Clave_Rol==1 || Auth::user()->Clave_Rol==2)
            <a class="side-font sidebar-margin-elements @if(request()->path() == 'Admin/Status')){ active } @else {} @endif" href="{{ url('/Admin/Status') }}"><i class="fas fa-spinner"></i> Estado</a>
        @endif

        @if(Auth::user()->Clave_Rol==1||Auth::user()->Clave_Rol==2)
            <a class="side-font sidebar-margin-elements @if(request()->path() == 'Admin/Usuarios')){ active } @else {} @endif" href="{{ url('/Admin/Usuarios') }}"><i class="fas fa-users"></i> Usuarios</a>
        @endif

        @if(Auth::user()->Clave_Rol==4 || Auth::user()->Clave_Rol==3)
            <a class="side-font sidebar-margin-elements @if(request()->path() == 'Admin/Proyectos')){ active } @else {} @endif" href="{{ url('/Admin/Proyectos') }}"><i class="fas fa-tasks"></i> Proyectos</a>
        @endif

        @if(Auth::user()->Clave_Rol==4)
            <a class="side-font sidebar-margin-elements @if(request()->path() == 'Admin/Etapas')){ active } @else {} @endif" href="{{ url('/Admin/Etapas') }}"><i class="fas fa-address-book"></i> Etapas</a>
        @endif

        @if(Auth::user()->Clave_Rol==4)
            <a class="side-font sidebar-margin-elements @if(request()->path() == 'Admin/RolesProyectos')){ active } @else {} @endif" href="{{ url('/Admin/RolesProyectos') }}"><i class="fas fa-address-book"></i> Roles en Proyectos</a>
        @endif

        @if(Auth::user()->Clave_Rol==1 || Auth::user()->Clave_Rol==2)
            <a class="side-font sidebar-margin-elements @if(request()->path() == 'Admin/RolesRASIC')){ active } @else {} @endif" href="{{ url('/Admin/RolesRASIC') }}"><i class="fas fa-check-square"></i> Roles RASIC</a>
        @endif

        @if(Auth::user()->Clave_Rol==1 || Auth::user()->Clave_Rol==2)
            <a class="side-font sidebar-margin-elements @if(request()->path() == 'Admin/Indicador')){ active } @else {} @endif" href="{{ url('/Admin/Indicador') }}"><i class="fas fa-chart-line"></i> Indicadores</a>
        @endif

        @if(Auth::user()->Clave_Rol==1 || Auth::user()->Clave_Rol==2)
            <a class="side-font sidebar-margin-elements @if(request()->path() == 'Admin/Fases')){ active } @else {} @endif" href="{{ url('/Admin/Fases') }}"><i class="fas fa-business-time"></i> Fases</a>
        @endif

        @if(Auth::user()->Clave_Rol==1 || Auth::user()->Clave_Rol==2)
            <a class="side-font sidebar-margin-elements @if(request()->path() == 'Admin/Enfoques')){ active } @else {} @endif" href="{{ url('/Admin/Enfoques') }}"><i class="fas fa-calendar-week"></i> Enfoques</a>
        @endif

        @if(Auth::user()->Clave_Rol==1 || Auth::user()->Clave_Rol==2)
            <a class="side-font sidebar-margin-elements @if(request()->path() == 'Admin/Trabajos')){ active } @else {} @endif" href="{{ url('/Admin/Trabajos') }}"><i class="fas fa-network-wired"></i> Trabajos</a>
        @endif

        @if(Auth::user()->Clave_Rol==2 || Auth::user()->Clave_Rol==4 || Auth::user()->Clave_Rol==3)
            <a class="side-font sidebar-margin-elements @if(request()->path() == 'Admin/Actividades')){ active } @else {} @endif" href="{{ url('/Admin/Actividades') }}"><i class="fas fa-clipboard-list"></i> Actividades</a>
        @endif
    @endauth

        <a class="logout_sidebar_button" href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();" style="background-color: #0000007d !important;"><i class="material-icons" style="vertical-align: bottom;">
                power_settings_new
            </i> {{ __('Salir') }}
        </a>
</div>
<div class="fixContainer mb-4">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true"></div>
    @yield('content')
</div>
@yield('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha256-bqVeqGdJ7h/lYPq6xrPv/YGzMEb6dNxlfiTUHSgRCp8=" crossorigin="anonymous"></script>
<script type="text/javascript">
    function ChangeCompany(){
        $('#myModal').load( '{{ url('/home/selectCompany') }}',function(response, status, xhr){
            if ( status == "success" ) {
                $('#myModal').modal('show');
            }else{
                Swal.fire({
                    type: 'Error',
                    title: 'Error',
                    text: 'Hubo un error al cargar la vista'
                })
            }
        });
    }
</script>
</html>
