<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nueva Actividad</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Descripción</label>
                        <input class="form-control" type="text" id="descripcion" name="descripcion">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token"/>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Compañía</label>
                        <select class="form-control" name="compania" id="compania">
                            @foreach ($compania as $item)
                                <option value="{{$item->Clave}}">{{$item->Descripcion}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Proyectos</label>
                        <select class="form-control" name="proyectos" id="proyectos">
                            @foreach ($proyectos as $item)
                                <option value="{{$item->Clave}}">{{$item->Descripcion}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Fases</label>
                        <select class="form-control" name="fases" id="fases">
                            @foreach ($fases as $item)
                                <option value="{{$item->Clave}}">{{$item->Descripcion}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Estado</label>
                        <select class="form-control" name="status" id="status">
                            @foreach ($status as $item)
                                <option value="{{$item->Clave}}">{{$item->Status}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Decisión</label>
                        <input class="form-control" name="decision" id="decision"/>
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Fecha de Acción</label>
                        <input class="form-control" name="FechaAccion" id="FechaAccion"/>
                        
                    </div>
                </div>                
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <i class="fas fa-times"></i></button>
            <button type="button" class="btn btn-primary" id="save">Guardar <i class="fas fa-save"></i></button>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){        
        $('#save').click(function(){
            var table=$('#table').DataTable();
            var descripcion=$('#descripcion').val();
            var FechaAccion=$('#FechaAccion').val();
            var decision=$('#decision').val();
            var compania=$('#compania').val();
            var companiaText=$('#compania option:selected').text();
            var proyectos=$('#proyectos').val();
            var proyectosText=$('#proyectos option:selected').text();
            var fases=$('#fases').val();
            var fasesText=$('#fases option:selected').text();
            var status=$('#status').val();
            var statusText=$('#status option:selected').text();
            var token=$('#_token').val();
            $.post('{{ url('/Admin/Actividades/Create')}}',{_token:token,descripcion:descripcion,compania:compania,fechaAccion:FechaAccion,decision:decision,proyecto:proyectos,fase:fases,status:status},function(data ){                             
                $('#Alert').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Listo!</strong> Se agregó correctamente.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');                                              
                var node=table.rows
                .add([{ 0:data.actividad.Clave, 1:companiaText, 2:proyectosText,3:fasesText,4:descripcion,5:FechaAccion,6:decision,7:statusText, 8:'<div class="btn-group" role="group" aria-label="Basic example"><button type="button" class="btn btn-primary btn-sm edit" clave="'+data.actividad.Clave+'" onclick="edit(this);">Editar <i class="fas fa-edit"></i></button><button type="button" class="btn btn-danger btn-sm delete" clave="'+data.actividad.Clave+'" onclick="deleted(this);">Eliminar<i class="fas fa-trash-alt"></i></button></div>'}])
                .draw()
                .nodes();                
                $( node ).find('td').eq(8).addClass('text-right');
                $('#myModal').modal('hide');
            })
            .fail(function(data) {                
                Swal.fire({
                    type: 'error',
                    title: 'Error',
                    text: data.responseJSON.message
                })
            });                    
        });
    });
</script>