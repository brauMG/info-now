@extends('layouts.verify')

@section('content')
    <div class="wrapper-less">
        <div class="container-less">
            <div class="card">
                <div class="card-header">{{ __('Verifique su dirección de correo electrónico') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Se ha enviado un enlace de verificación a su dirección de correo electrónico.') }}
                        </div>
                        <div class="form-group">
                            {{ __('Si ya has verificado tu dirección de correo, recarga la página. O presiona salir e inicia sesión nuevamente.') }}
                        </div>
                        <form class="d-inline" method="POST" action=href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-recovery">{{ __('Salir.') }}</button>
                        </form>
                    @else
                        <div class="form-group">
                            {{ __('Para continuar deberas validar tu correo electrónico, haz click a continuación para enviarte un enlace de verificación a tu correo.') }}
                        </div>
                        <form class="d-inline" method="GET" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-recovery">{{ __('Click Aquí.') }}</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <ul class="bg-bubbles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
@endsection
