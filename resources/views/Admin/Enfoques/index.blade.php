@extends('Shared.layout')
@if($compania!=null)
    @section('company',$compania->Descripcion)
@endif
@section('title', 'Enfoques')
@section('content')
    <div class="row">
        @include('Shared.sidebar') 
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">           
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Enfoques</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary" id="new">Agregar<i class="fas fa-plus"></i></button>                        
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
                            <th>Descripcion</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enfoque as $item)
                            <tr id="{{$item->Clave}}">
                                <td>{{$item->Clave}}</td>
                                <td>{{$item->Descripcion}}</td>
                                <td class="text-right">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-primary btn-sm edit" clave="{{$item->Clave}}" onclick="edit(this);">Edit <i class="fas fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm delete" clave="{{$item->Clave}}" onclick="deleted(this);">Delete <i class="fas fa-trash-alt"></i></button>                                            
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
            $('#myModal').load( '{{ url('/Admin/Enfoques/Edit') }}/'+clave,function(response, status, xhr){
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
                title: '¿Esta seguro?',
                text: "¡No podrás revertir esto!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminalo!'
            }).then(function(result){                    
                if (result.value) {                        
                    $.post('{{ url('/Admin/Enfoques/Delete/') }}/'+clave,{_token:'{{ csrf_token() }}'},function(data){                            
                        if(data.error==false){
                            table
                            .row(tr )
                            .remove()
                            .draw();
                            Swal.fire(
                                'Eliminado!',
                                'Registro eliminado.',
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
                $('#myModal').load( '{{ url('/Admin/Enfoques/New') }}',function(response, status, xhr){
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
            $('#nav-enfoques').addClass('active');
            $('#nav-enfoques').css({"background": "#9b9634","color": "white"});
        });
    </script>
@endsection