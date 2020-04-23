<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Actualizar Actividades</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="clave" value="{{$actividad->Clave}}" id="clave"/>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token"/>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Descripción</label>
                        <input class="form-control" type="text" id="descripcion" name="descripcion" value="{{$actividad->Descripcion}}">                                                
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
                        <input class="form-control" name="decision" id="decision" value="{{$actividad->Decision}}"/>                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Fecha de Accion</label>
                        <input class="form-control" name="FechaAccion" id="FechaAccion" value="{{$actividad->FechaAccion}}"/>
                        
                    </div>
                </div>                
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <i class="fas fa-times"></i></button>
            <button type="button" class="btn btn-primary" id="update">Actualizar <i class="fas fa-edit"></i></button>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        var table=$('#table').DataTable();
        $('#compania').val('{{$actividad->Clave_Compania}}');        
        $('#proyectos').val('{{$actividad->Clave_Proyecto}}');
        $('#fases').val('{{$actividad->Clave_Fase}}');
        $('#status').val('{{$actividad->Clave_Status}}');
        $('#update').click(function(){
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
            var clave=$('#clave').val();
            var tr=  $('tr#'+clave);
            $.post('{{ url('/Admin/Actividades/Update')}}',{_token:token,clave:clave,descripcion:descripcion,compania:compania,fechaAccion:FechaAccion,decision:decision,proyecto:proyectos,fase:fases,status:status},function(data ){                             
                $('#Alert').html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Listo!</strong> Se actualizó correctamente.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                var data=table.row(tr).data();                
                data[1]=companiaText;
                data[2]=proyectosText;
                data[3]=fasesText;
                data[4]=descripcion;
                data[5]=FechaAccion;
                data[6]=decision;
                data[7]=statusText;
                
                table
                .row( tr )
                .data( data )
                .draw();
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