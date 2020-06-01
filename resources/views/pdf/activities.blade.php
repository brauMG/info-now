@extends('layouts.pdf')
@section('content')
        <div class="text-center">
            <table class="table table-bordered">
                <thead class="table-header" style="font-size: 0.5em !important; background-color: #c6e2f5 !important; color: black !important; vertical-align: middle !important;">
                <tr>
                    <th scope="col" style="text-transform: uppercase">Proyecto</th>
                    <th scope="col" style="text-transform: uppercase">Fase</th>
                    <th scope="col" style="text-transform: uppercase">Etapa</th>
                    <th scope="col" style="text-transform: uppercase">Usuario</th>
                    <th scope="col" style="text-transform: uppercase">Descripción</th>
                    <th scope="col" style="text-transform: uppercase">Decisión</th>
                    <th scope="col" style="text-transform: uppercase">Fecha de Creación</th>
                    <th scope="col" style="text-transform: uppercase">Estado de Revisión</th>
                    <th scope="col" style="text-transform: uppercase">Fecha de Revisión</th>
                    <th scope="col" style="text-transform: uppercase">Hora de Revisión</th>
                    <th scope="col" style="text-transform: uppercase">Fecha de Vencimiento</th>
                    <th scope="col" style="text-transform: uppercase">Hora de Vencimiento</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($actividades as $item)
                    <tr id="{{$item->Clave}}">
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->Proyecto}}</td>
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->Fase}}</td>
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->Etapa}}</td>
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->Usuario}}</td>
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->Descripcion}}</td>
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->Decision}}
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->FechaCreacion}}</td>
                        @if($item->Estado == 0)
                            <td class="td td-center" style="color: black; font-size: 0.5em !important;">Pendiente</td>
                        @elseif($item->Estado == 1)
                            <td class="td td-center" style="color: green; font-size: 0.5em !important;">Aprobada</td>
                        @elseif($item->Estado == 2)
                            <td class="td td-center" style="color: red; font-size: 0.5em !important;">Desaprobada</td>
                        @endif
                        @if($item->Fecha_Revision == null)
                            <td class="td td-center" style="color: black; font-size: 0.5em !important;">Pendiente</td>
                            <td class="td td-center" style="color: black; font-size: 0.5em !important;">Pendiente</td>
                        @elseif($item->Fecha_Revision > $item->Fecha_Vencimiento)
                            <td class="td td-center" style="color: red; font-size: 0.5em !important;">Se reviso tarde el: {{$item->Fecha_Revision}}</td>
                            <td class="td td-center" style="color: red; font-size: 0.5em !important;">Se reviso a las: {{$item->Hora_Revision}}</td>
                        @elseif($item->Fecha_Revision <= $item->Fecha_Vencimiento)
                            <td class="td td-center" style="color: green; font-size: 0.5em !important;">Se reviso a tiempo el: {{$item->Fecha_Revision}}</td>
                            <td class="td td-center" style="color: green; font-size: 0.5em !important;">Se reviso a las: {{$item->Hora_Revision}}</td>
                        @endif
                        @if($date == $item->Fecha_Vencimiento)
                            @if($time > $item->Hora_Vencimiento)
                                <td class="td td-center" style="color: red; font-size: 0.5em !important;">Vencio hoy: {{$item->Fecha_Vencimiento}}</td>
                                <td class="td td-center" style="color: red; font-size: 0.5em !important;">Vencio hoy a las: {{$item->Hora_Vencimiento}}</td>
                            @else
                                <td class="td td-center" style="color: black; font-size: 0.5em !important;">Vence hoy: {{$item->Fecha_Vencimiento}}</td>
                                <td class="td td-center" style="color: black; font-size: 0.5em !important;">Vence hoy a las: {{$item->Hora_Vencimiento}}</td>
                            @endif
                        @elseif($date < $item->Fecha_Vencimiento)
                            <td class="td td-center" style="color: green; font-size: 0.5em !important;">Vence el: {{$item->Fecha_Vencimiento}}</td>
                            <td class="td td-center" style="color: green; font-size: 0.5em !important;">Vence a las: {{$item->Hora_Vencimiento}}</td>
                        @else
                            <td class="td td-center" style="color: red; font-size: 0.5em !important;">Vencio el: {{$item->Fecha_Vencimiento}}</td>
                            <td class="td td-center" style="color: red; font-size: 0.5em !important;">Vencio a las: {{$item->Hora_Vencimiento}}</td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
@endsection
