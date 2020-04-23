<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nuevo Proyecto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12 col-md-4"  style="display: none;">
                    <div class="form-group">
                        <select class="form-control" name="compania" id="compania">
                            @foreach ($company as $item)
                                <option value="{{$item->Clave}}">{{$item->Descripcion}}</option>
                            @endforeach
                        </select>                      
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Description</label>
                        <input class="form-control" type="text" id="descripcion" name="descripcion">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token"/>
                        <div class="invalid-feedback" id="error_descripcion" style="display: none;"></div>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Area</label>
                        <select class="form-control" id="area" name="area">
                            @if($areas->count()==0)
                                <option value="-1">Agrege primero las areas</option>
                            @endif
                            @foreach($areas as $item)
                                <option value="{{$item->Clave}}">{{$item->Descripcion}}</option>
                            @endforeach
                        </select>
                        @if($areas->count()==0)
                             <div class="invalid-feedback" id="error_area">
                                *El Company Admin tiene que crear las areas.
                            </div>
                        @else
                            <div class="invalid-feedback" id="error_area" style="display: none;"></div>                            
                        @endif
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Enfoque</label>
                        <select class="form-control" id="enfoque" name="enfoque">
                            @if($enfoques->count()==0)
                                <option value="-1">Agrege primero los enfoques</option>
                            @endif
                            @foreach($enfoques as $item)
                                <option value="{{$item->Clave}}">{{$item->Descripcion}}</option>
                            @endforeach
                        </select>
                        @if($enfoques->count()==0)
                             <div class="invalid-feedback" id="error_enfoque">
                                *El Admin tiene que crear los enfoques.
                            </div>
                        @else
                            <div class="invalid-feedback" id="error_enfoque" style="display: none;"></div>                            
                        @endif
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Trabajo</label>
                        <select class="form-control" id="trabajo" name="trabajo">
                            @if($enfoques->count()==0)
                                <option value="-1">Agrege primero los trabajos</option>
                            @endif
                            @foreach($trabajos as $item)
                                <option value="{{$item->Clave}}">{{$item->Descripcion}}</option>
                            @endforeach
                        </select>
                        @if($trabajos->count()==0)
                             <div class="invalid-feedback" id="error_trabajo">
                                *El Admin tiene que crear los trabajos.
                            </div>
                        @else
                            <div class="invalid-feedback" id="error_trabajo" style="display: none;"></div>                            
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Fase</label>
                        <select class="form-control" id="fase" name="fase">
                            @if($fases->count()==0)
                                <option value="-1">Agrege primero las fases</option>
                            @endif
                            @foreach($fases as $item)
                                <option value="{{$item->Clave}}">{{$item->Descripcion}}</option>
                            @endforeach
                        </select>
                        @if($fases->count()==0)
                             <div class="invalid-feedback" id="error_fase">
                                *El Admin tiene que crear las fases.
                            </div>
                        @else
                            <div class="invalid-feedback" id="error_fase" style="display: none;"></div>                            
                        @endif
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Indicador</label>
                        <select class="form-control" id="indicador" name="indicador">
                            @if($indicadores->count()==0)
                                <option value="-1">Agrege primero los indicadores</option>
                            @endif
                            @foreach($indicadores as $item)
                                <option value="{{$item->Clave}}">{{$item->Descripcion}}</option>
                            @endforeach
                        </select>
                        @if($indicadores->count()==0)
                             <div class="invalid-feedback" id="error_indicador">
                                *El Admin tiene que crear los indicadores.
                            </div>
                        @else
                            <div class="invalid-feedback" id="error_indicador" style="display: none;"></div>                            
                        @endif
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Objetivo</label>
                        <input class="form-control" id="objetivo" name="objetivo"/>
                        <div class="invalid-feedback" id="error_objectivo" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close <i class="fas fa-times"></i></button>
            <button type="button" class="btn btn-primary" id="save">Save <i class="fas fa-save"></i></button>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        
        $('#save').click(function(){
            var error=false;
            var table=$('#table').DataTable();
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
            var token=$('#_token').val();

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

            if(objetivo==""){
                $('#objetivo').addClass('is-invalid');
                $('#error_objetivo').html('*Ingresa un objectivo');
                $('#error_objetivo').show();
                error=true;
            }
            if(error==false){
                $.post('{{ url('/Admin/Proyectos/Create')}}',{_token:token,compania:compania,descripcion:descripcion,area:area,fase:fase,enfoque:enfoque,trabajo:trabajo,indicador:indicador,objectivo:objectivo},function(data ){
                    $('#Alert').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Listo!</strong> Se agrego correctamente<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');                                              
                    var node=table.rows
                    .add([{ 0:data.proyecto.Clave, 1:companiaText, 2:descripcion,3:areaText,4:faseText,5:enfoqueText,6:trabajoText,7:indicadorText,8:objectivo ,9:'<div class="btn-group" role="group" aria-label="Basic example"><button type="button" class="btn btn-primary btn-sm edit" clave="'+data.proyecto.Clave+'" onclick="edit(this);">Editar <i class="fas fa-edit"></i></button><button type="button" class="btn btn-danger btn-sm delete" clave="'+data.proyecto.Clave+'" onclick="deleted(this);">Eliminar<i class="fas fa-trash-alt"></i></button></div>'}])
                    .draw()
                    .nodes();                
                    $( node ).find('td').eq(9).addClass('text-right');
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