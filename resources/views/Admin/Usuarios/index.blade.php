@extends('layouts.app')
@if($compania!=null)
    @section('company',$compania->Descripcion)
@endif
@section('content')
    @include('layouts.top-nav')
    <div class="container container-rapi2">
        <main role="main" class="ml-sm-auto">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2 h2-less">Usuarios</h1>
            </div>
            <div class="btn-toolbar mb-2 mb-md-0">
                <button type="button" class="btn-less btn btn-info" id="new" onclick="AddUser();"><i class="fas fa-plus"></i> Agregar Usuario</button>
                <button type="button" class="btn-less btn btn-info" id="new" onclick="Import();" style="margin-left: 1%"><i class="fas fa-plus"></i> Importar Lista de Usuarios</button>
            </div>
        </main>
        <div id="Alert"></div>
    </div>

    <div class="container">
        <div data-simplebar class="table-responsive table-height">
            <div class="col text-center">
                <table class="table table-striped table-bordered mydatatable">
                    <thead class="table-header">
                    <tr>
                        <th scope="col" style="text-transform: uppercase">Clave</th>
                        <th scope="col" style="text-transform: uppercase">Compania</th>
                        <th scope="col" style="text-transform: uppercase">Nombre(s)</th>
                        <th scope="col" style="text-transform: uppercase">Correo</th>
                        <th scope="col" style="text-transform: uppercase">Área</th>
                        <th scope="col" style="text-transform: uppercase">Puesto</th>
                        <th scope="col" style="text-transform: uppercase">Rol</th>
                        <th scope="col" style="text-transform: uppercase">Ultima Sesión</th>
                        <th scope="col" style="text-transform: uppercase">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $item)
                            <tr id="{{$item->Clave}}">
                                <td class="td td-center">{{$item->Clave}}</td>
                                <td class="td td-center">{{$item->Compania}}</td>
                                <td class="td td-center">{{$item->Nombres}}</td>
                                <td class="td td-center">{{$item->Correo}}</td>
                                <td class="td td-center">{{$item->Area}}</td>
                                <td class="td td-center">{{$item->Puesto}}</td>
                                <td class="td td-center">{{$item->Rol}}</td>
                                <td class="td td-center">{{$item->UltimoLogin}}</td>
                                <td  class="td td-center">
                                    <a class="btn-row btn btn-warning no-href" clave="{{$item->Clave}}" onclick="edit(this);"><i class="fas fa-edit"></i>Editar</a>
                                    <a class="btn-row btn btn-danger no-href" clave="{{$item->Clave}}" onclick="deleted(this);"><i class="fas fa-trash-alt"></i>Eliminar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-footer">
                    <tr>
                        <th style="text-transform: uppercase">Clave</th>
                        <th style="text-transform: uppercase">Compania</th>
                        <th style="text-transform: uppercase">Nombre(s)</th>
                        <th style="text-transform: uppercase">Correo</th>
                        <th style="text-transform: uppercase">Área</th>
                        <th style="text-transform: uppercase">Puesto</th>
                        <th style="text-transform: uppercase">Rol</th>
                        <th style="text-transform: uppercase">Ultima Sesión</th>
                        <th style="text-transform: uppercase">Acciones</th>

                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <script>
        $('.mydatatable').DataTable();

        function AddUser() {
            $('#myModal').load( '{{ url('/Admin/Usuarios/New') }}',function(response, status, xhr)
            {
                if (status == "success")
                    $('#myModal').modal('show');
            });
        }

        function Import() {
            $('#myModal').load( '{{ url('/Admin/Usuarios/ImportExcelIndex') }}',function(response, status, xhr)
            {
                if (status == "success")
                    $('#myModal').modal('show');
            });
        }

        function edit(button){
            var clave = $(button).attr('clave');
            $('#myModal').load( '{{ url('/Admin/Usuarios/Edit') }}/'+clave,function(response, status, xhr){
                if ( status == "success" ) {
                    $('#myModal').modal('show');
                }
            } );
        }
        function changePassword(button){
            var clave = $(button).attr('clave');
            $('#myModal').load( '{{ url('/Admin/Usuarios/ChangePassword') }}/'+clave,function(response, status, xhr){
                if ( status == "success" ) {
                    $('#myModal').modal('show');
                }
            } );
        }
        function deleted(button){
            var table=$('#table').DataTable();
            var clave = $(button).attr('clave');
            var tr=$(button).closest('tr');
            Swal.fire({
                title: 'Estas seguro',
                text: "Este cambio no puede ser revertirdo",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminalo'
            }).then(function(result)  {
                if (result.value) {
                    $.post('{{ url('/Admin/Usuarios/Delete/') }}/'+clave,{_token:'{{ csrf_token() }}'},function(data){
                        if(data.error==false){
                            table
                            .row(tr )
                            .remove()
                            .draw();
                            Swal.fire(
                                'Eliminado',
                                'Tu registro ha sido eliminado',
                                'success'
                            )
                        }
                    })
                    .fail(function(data){
                        Swal.fire({
                            type: 'error',
                            title: 'Error',
                            text: data.responseJSON.message
                        })
                    });

                }
            })
        }
        $(document).ready(function(){
            var table=$('#table').DataTable({
                language:
                {
                    processing: "Cargando",
                    search: "_INPUT_",
                    searchPlaceholder: "Buscar en Registros",
                    lengthMenu: "Mostrar _MENU_ Registros",
                    info: "Registros _START_  al  _END_  de _TOTAL_",
                    infoEmpty: "No hay registros disponibles",
                    infoFiltered: "(filtrado de _MAX_ registros)",
                    oPaginate:
                        {
                            sFirst: "Primero",
                            sPrevious: "Anterior",
                            sNext: "Siguiente",
                            sLast: "Ultimo"
                        },
                    zeroRecords: "No hay registros"
                }
            });

            $('#new').click(function(){
                if('{{Auth::user()->Clave_Compania}}'==''){
                    Swal.fire({
                        type: 'info',
                        title: 'Compañia',
                        text: 'Falta seleccionar compañia antes de ingresar el usuario'
                    })
                }else{
                    $('#myModal').load( '{{ url('/Admin/Usuarios/New') }}',function(response, status, xhr){
                        if ( status == "success" ) {
                            $('#myModal').modal('show');
                        }else{
                            Swal.fire({
                                type: 'error',
                                title: 'Error',
                                text: response
                            })
                        }
                    });
                }

            });

            $('#import').click(function(){
                $('#myModal').load('{{ url('/Admin/Usuarios/ImportExcelIndex') }}',function(response, status, xhr){
                    if ( status == "success" ) {
                        $('#myModal').modal('show');
                    }else{
                        Swal.fire({
                            type: 'error',
                            title: 'Error',
                            text: response
                        })
                    }
                });
            });

            $("#nav-usuarios").addClass("active");
            $('#nav-usuarios').css({"background": "#9b9634","color": "white"});

        });
    </script>
@endsection
