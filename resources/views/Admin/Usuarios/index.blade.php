@extends('Shared.layout')
@section('title', 'Usuarios')
@if($compania!=null)
    @section('company',$compania->Descripcion)
@endif
@section('content')
    <div class="row">
        @include('Shared.sidebar') 
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">           
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2"> Usuarios</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary" id="new">Nuevo <i class="fas fa-plus"></i></button>     
                        &nbsp;
                        <button type="button" class="btn btn-sm btn-outline-secondary" id="import">Importar<i class="fas fa-file-excel"></i></button>                   
                    </div>                    
                </div>
            </div>
            <div id="Alert">
                
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover" id="table">
                    <thead>
                        <tr>
                            <th>Clave</th>
                            <th>Compania</th>                            
                            <th>Nombre(s)</th>
                            <th>Correo</th>
                            <th>Area</th>
                            <th>Puesto</th>
                            <th>Rol</th>
                            <th>UltimoLogin</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $item)
                            <tr id="{{$item->Clave}}">
                                <td>{{$item->Clave}}</td>
                                <td>{{$item->Compania}}</td>                                
                                <td>{{$item->Nombres}}</td>
                                <td>{{$item->Correo}}</td>
                                <td>{{$item->Area}}</td>
                                <td>{{$item->Puesto}}</td>
                                <td>{{$item->Rol}}</td>
                                <td>{{$item->UltimoLogin}}</td>
                                <td class="text-right">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-primary btn-sm edit" clave="{{$item->Clave}}" onclick="edit(this);">Editar <i class="fas fa-edit"></i></button>
                                        <button type="button" class="btn btn-success btn-sm change" clave="{{$item->Clave}}" onclick="changePassword(this);">Cambiar Contraseña <i class="fas fa-key"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm delete" clave="{{$item->Clave}}" onclick="deleted(this);">Eliminar <i class="fas fa-trash-alt"></i></button>                                            
                                    </div>
                                </td>
                            </tr>    
                        @endforeach
                                         
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <script>
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