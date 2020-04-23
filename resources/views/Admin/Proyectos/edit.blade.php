<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Actualizar Proyecto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12 col-md-4" style="display: none;">
                    <div class="form-group">
                        <label>Compañía</label>
                        <select class="form-control" id="compania" name="compania">
                            @foreach($companias as $item)
                                <option value="{{$item->Clave}}">{{$item->Descripcion}}</option>
                            @endforeach
                        </select>                        
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Descripción</label>
                        <input class="form-control" type="text" id="descripcion" name="descripcion" value="{{$proyecto->Descripcion}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token"/>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Área</label>
                        <select class="form-control" id="area" name="area">
                            @foreach($areas as $item)
                                <option value="{{$item->Clave}}">{{$item->Descripcion}}</option>
                            @endforeach
                        </select>                        
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Enfoque</label>
                        <select class="form-control" id="enfoque" name="enfoque">
                            @foreach($enfoques as $item)
                                <option value="{{$item->Clave}}">{{$item->Descripcion}}</option>
                            @endforeach
                        </select>                        
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Trabajo</label>
                        <select class="form-control" id="trabajo" name="trabajo">
                            @foreach($trabajos as $item)
                                <option value="{{$item->Clave}}">{{$item->Descripcion}}</option>
                            @endforeach
                        </select>                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Fase</label>
                        <select class="form-control" id="fase" name="fase">
                            @foreach($fases as $item)
                                <option value="{{$item->Clave}}">{{$item->Descripcion}}</option>
                            @endforeach
                        </select>                        
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Indicador</label>
                        <select class="form-control" id="indicador" name="indicador">
                            @foreach($indicadores as $item)
                                <option value="{{$item->Clave}}">{{$item->Descripcion}}</option>
                            @endforeach
                        </select>                        
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Objetivo</label>
                        <input class="form-control" id="objetivo" name="objetivo" value="{{$proyecto->Objectivo}}"/>
                        <input type="hidden" id="clave" name="clave" value="{{$proyecto->Clave}}"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close <i class="fas fa-times"></i></button>
            <button type="button" class="btn btn-primary" id="update">Update <i class="fas fa-edit"></i></button>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        var table=$('#table').DataTable();
        $('#compania').val('{{$proyecto->Clave_Compania}}');        
        $('#area').val('{{$proyecto->Clave_Area}}');
        $('#enfoque').val('{{$proyecto->Clave_Enfoque}}');
        $('#trabajo').val('{{$proyecto->Clave_Trabajo}}');
        $('#fase').val('{{$proyecto->Clave_Fase}}');
        $('#indicador').val('{{$proyecto->Clave_Indicador}}');
        $('#update').click(function(){
            var error=false;
            var compania=$('#compania').val();
            var companiaText=$('#compania option:selected').text();

            var descripcion=$('#descripcion').val();

            var area=$('#area').val();
            var areaText=$('#area option:selected').text();

            var fase=$('#fase').val();
            var faseText=$('#fase option:selected').text();

            var enfoque=$('#enfoque').val();
            var enfoqueText=$('#enfoque option:selected').text();

            var trabajo=$('#trabajo').val();
            var trabajoText=$('#trabajo option:selected').text();
            
            var indicador=$('#indicador').val();
            var indicadorText=$('#indicador option:selected').text();

            var objectivo=$('#objetivo').val();
            var clave=$('#clave').val();
            var token=$('#_token').val();
            var tr=  $('tr#'+clave);

            if(descripcion==""){
                $('#descripcion').addClass('is-invalid');
                $('#error_descripcion').html('*Ingresa una descripcion');
                $('#error_descripcion').show();
                error=true;
            }
          
            if('{{$areas->count()}}'=='0'){
                error=true;
            }

            if('{{$enfoques->count()}}'=='0'){
                error=true;
            }
            if('{{$trabajos->count()}}'=='0'){
                error=true;
            }
            if('{{$fases->count()}}'=='0'){
                error=true;
            }
            if('{{$indicadores->count()}}'=='0'){
                error=true;
            }
            if(error==false){
                $.post('{{ url('/Admin/Proyectos/Update')}}',{_token:token,clave:clave,compania:compania,descripcion:descripcion,area:area,fase:fase,enfoque:enfoque,trabajo:trabajo,indicador:indicador,objectivo:objectivo},function(data ){                             
                    $('#Alert').html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Listo!</strong> Se actualizó correctamente.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    var data=table.row(tr)
                    .data();
                    data[1]=companiaText;
                    data[2]=descripcion;
                    
                    data[3]=areaText;
                    data[4]=faseText;
                    data[5]=enfoqueText;
                    data[6]=trabajoText;
                    data[7]=indicadorText;
                    data[8]=objectivo;
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
            }
        });
    });
</script>