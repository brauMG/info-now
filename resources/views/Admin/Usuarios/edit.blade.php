<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Actualizar Usuarios</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token"/>
                    <input type="hidden" name="clave" value="{{ $usuario->Clave}}" id="clave"/>
                    <div class="col-12 col-md-6" style="display: none;">
                        <div class="form-group">
                            <label>Company</label>
                            <select class="form-control" name="compania" id="compania">
                                @foreach ($company as $item)
                                    <option value="{{$item->Clave}}" selected="true">{{$item->Descripcion}}</option>
                                @endforeach
                            </select>                        
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Nombre(s)</label>
                            <input class="form-control" type="text" id="nombres" name="nombres" value="{{$usuario->Nombres}}">
                             <div class="invalid-feedback" id="error_nombres" style="display: none;"></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Correo</label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="email" id="correo" name="correo" value="<?= Str::replaceFirst('@'.$compania->Dominio, '', $usuario->Correo)?>" aria-label="correo" aria-describedby="basic-addon_email">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic_addon_email">{{'@'.$compania->Dominio}}</span>
                                </div>
                            </div>
                            <div class="invalid-feedback" id="error_correo" style="display: none;"></div>
                        </div>
                    </div>                   
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Area</label>
                            <select class="form-control" name="area" id="area">
                                @if($area->count()==0)
                                    <option value="-1" selected="true">No hay areas</option>
                                @else
                                    <option value="0" selected="true">Seleccione un area</option>
                                @endif
                                @foreach ($area as $item)
                                    <option value="{{$item->Clave}}">{{$item->Descripcion}}</option>
                                @endforeach
                            </select>
                            @if($area->count()==0)
                                <div class="invalid-feedback" id="error_area">
                                    *Crea primero las areas <a href="{{ url('/Admin/Areas') }}" class="btn-link">aqui</a>.
                                </div>                            
                            @else                            
                                <div class="invalid-feedback" id="error_area" style="display: none;"></div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Rol</label>
                            <select class="form-control" name="rol" id="rol">
                                @foreach ($rol as $item)
                                    <option value="{{$item->Clave}}">{{$item->Rol}}</option>
                                @endforeach
                            </select>                        
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label>Puesto</label>
                            <select class="form-control" name="puesto" id="puesto">
                                @if($area->count()==0)
                                    <option value="-1" selected="true">No hay puestos</option>
                                @else
                                    <option value="0" selected="true">Seleccione un puesto</option>
                                @endif
                                @foreach ($puesto as $item)
                                    <option value="{{$item->Clave}}">{{$item->Puesto}}</option>
                                @endforeach
                            </select>
                            @if($puesto->count()==0)
                                <div class="invalid-feedback" id="error_puesto">
                                    *Crea primero los puestos <a href="{{ url('/Admin/Puestos') }}" class="btn-link">aqui</a>.
                                </div>
                            @else
                                <div class="invalid-feedback" id="error_puesto" style="display: none;"></div>                            
                            @endif
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
        $('#compania').val('{{$usuario->Clave_Compania}}');
        $('#area').val('{{$usuario->Clave_Area}}');
        $('#rol').val('{{$usuario->Clave_Rol}}');
        $('#puesto').val('{{$usuario->Clave_Puesto}}');
        
        $('#update').click(function(){
            var error=false;
            var nombres=$('#nombres').val();
            
            var correo=$('#correo').val(); 
            var dominio=$('#basic_addon_email').text();

            var compania=$('#compania').val();
            var companiaText=$('#compania option:selected').text();

            var area=$('#area').val();
            var areaText=$('#area option:selected').text();

            var rol=$('#rol').val();
            var rolText=$('#rol option:selected').text();

            var puesto=$('#puesto').val();
            var puestoText=$('#puesto option:selected').text();
            var clave=$('#clave').val();
            var token=$('#_token').val();
            var tr=  $('tr#'+clave);

            if(nombres==""){
                $('#nombres').addClass('is-invalid');
                $('#error_nombres').html('*Ingresa un nombre');
                $('#error_nombres').show();
                error=true;
            }
            if(correo==""){
                $('#correo').addClass('is-invalid');
                $('#error_correo').html('*Ingresa un correo');
                $('#error_correo').show();
                error=true;
            }
            

            if(area=="0"){
                $('#error_area').html('*Selecciona un puesto');
                $('#error_area').show();
                $('#area').addClass('is-invalid');
                error=true;
            }
            if(area=="-1"){
                $('#error_area').removeClass('text-muted');
                $('#area').addClass('is-invalid');
                error=true;
            }
            if(puesto=="0"){
                $('#error_puesto').html('*Selecciona un puesto');
                $('#error_puesto').show();
                $('#puesto').addClass('is-invalid');
                error=true;
            }
            if(puesto=="-1"){
                $('#error_puesto').removeClass('text-muted');
                $('#puesto').addClass('is-invalid');
                error=true;
            }
            if(error==false){
                $.post('{{ url('/Admin/Usuarios/Update')}}',{_token:token,clave:clave,compania:compania,nombres:nombres,correo:correo+dominio,area:area,puesto:puesto,rol:rol},function(data ){                             
                    $('#Alert').html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Listo!</strong> Se actualizo correctamente<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    var info=table.row(tr)
                    .data();
                    info[1]=companiaText;                
                    info[2]=nombres;
                    info[3]=correo+dominio;
                    info[4]=areaText;
                    info[5]=puestoText;
                    info[6]=rolText;
                
                    table
                    .row( tr )
                    .data( info )
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

        $('#nombres').change(function() {
            var nombres=$('#nombres').val();
            console.log(nombres);
            if(nombres!=""){
                if($('#nombres').hasClass( 'is-invalid')==true){
                    $('#nombres').removeClass('is-invalid');
                    $('#nombres').addClass( 'is-valid');
                    $('#error_nombres').hide();
                }
            }
        });
        $('#correo').change(function() {
            var nombres=$('#correo').val();
            console.log(nombres);
            if(nombres!=""){
                if($('#correo').hasClass( 'is-invalid')==true){
                    $('#correo').removeClass('is-invalid');
                    $('#correo').addClass( 'is-valid');
                    $('#error_correo').hide();
                }
            }
        });
        $('#area').change(function() {
            var nombres=$('#area').val();
            console.log(nombres);
            if(nombres!="0" &&nombres!="-1"){
                if($('#area').hasClass( 'is-invalid')==true){
                    $('#area').removeClass('is-invalid');
                    $('#area').addClass( 'is-valid');
                    $('#error_area').hide();
                }
            }
        });
        $('#puesto').change(function() {
            var nombres=$('#puesto').val();
            console.log(nombres);
            if(nombres!="0" &&nombres!="-1" ){
                if($('#puesto').hasClass( 'is-invalid')==true){
                    $('#puesto').removeClass('is-invalid');
                    $('#puesto').addClass( 'is-valid');
                    $('#error_puesto').hide();
                }
            }
        });

    });
</script>