@extends('Shared.layout')
@if($compania!=null)
    @section('company',$compania->Descripcion)
@endif
@section('title', 'Roles')
@section('content')
    <div class="row">
        @include('Shared.sidebar') 
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">           
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Rol</h1>
                
            </div>
            <div id="Alert">
                
            </div>
            <div class="table-responsive">
                <table class="table table-hover" id="table">
                    <thead>
                        <tr>
                            <th>Clave</th>
                            <th>Descripción</th>                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rol as $item)
                            <tr id="{{$item->Clave}}">
                                <td>{{$item->Clave}}</td>
                                <td>{{$item->Rol}}</td>                                
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
            $('#myModal').load( '{{ url('/Admin/Roles/Edit') }}/'+clave,function(response, status, xhr){
                if ( status == "success" ) {                        
                    $('#myModal').modal('show');
                }
            } );
        }
        function deleted(button){
            var clave = $(button).attr('clave');
            var tr=$(button).closest('tr');
            Swal.fire({
                title: '¿Está seguro?',
                text: "¡No podrás revertir esto!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar!'
            }).then(function(result){                    
                if (result.value) {                        
                    $.post('{{ url('/Admin/Roles/Delete/') }}/'+clave,{_token:'{{ csrf_token() }}'},function(data){                            
                        if(data.error==false){
                            table
                            .row(tr )
                            .remove()
                            .draw();
                            Swal.fire(
                                'Eliminar!',
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
            table=$('#table').DataTable({
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
                $('#myModal').load( '{{ url('/Admin/Roles/New') }}',function(response, status, xhr){
                    if ( status == "success" ) {                        
                        $('#myModal').modal('show');
                    }
                });                
            });
            $('#nav-roles').addClass('active');
            $('#nav-roles').css({"background": "#9b9634","color": "white"});                 
        });
    </script>
@endsection