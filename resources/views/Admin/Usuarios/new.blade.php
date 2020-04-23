@section('title', 'Usuarios')
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nuevo usuarios</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token"/>
                <div class="col-12 col-md-6" style="display: none;">
                    <div class="form-group">
                        <label>Company</label>
                        <select class="form-control" name="compania" id="compania">
                            @foreach ($company as $item)
                                <option value="{{$item->Clave}}" value="true">{{$item->Descripcion}}</option>
                            @endforeach
                        </select>                        
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Nombre(s)</label>
                        <input class="form-control" type="text" id="nombres" name="nombres">
                        <div class="invalid-feedback" id="error_nombres" style="display: none;"></div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Correo</label>
                        <div class="input-group">
                            <input class="form-control" type="text" id="correo" name="correo" aria-label="correo" aria-describedby="basic_addon_email">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic_addon_email">{{'@'.$compania->Dominio}}</span>
                            </div>
                        </div>
                        <div class="invalid-feedback" id="error_correo" style="display: none;"></div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Contraseña</label>
                        <input class="form-control" type="password" id="contrasena" name="contrasena">
                        <div class="invalid-feedback" id="error_contrasena" style="display: none;"></div>
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
            </div>
            <div class="row">
                
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
                <div class="col-12 col-md-6">
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
            <button type="button" class="btn btn-primary" id="save">Guardar <i class="fas fa-save"></i></button>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){        
        $('#save').click(function(){
            var error=false;
            var table=$('#table').DataTable();
            var nombres=$('#nombres').val();
            var contrasena=$('#contrasena').val(); 

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

            var token=$('#_token').val();
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
            if(contrasena==""){
                $('#contrasena').addClass('is-invalid');
                $('#error_contrasena').html('*Ingresa una contraseña');
                $('#error_contrasena').show();
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
                $.post('{{ url('/Admin/Usuarios/Create')}}',{_token:token,compania:compania,nombres:nombres,correo:correo+dominio,contrasena:contrasena,area:area,puesto:puesto,rol:rol},function(data ){                             
                        $('#Alert').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Listo!</strong> Se agrego correctamente<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');                                              
                        var node=table.rows
                        .add([{ 0:data.user.Clave, 1:companiaText,2:nombres,3:correo+dominio,4:areaText,5:puestoText,6:rolText,7:'', 8:'<div class="btn-group" role="group" aria-label="Basic example"><button type="button" class="btn btn-primary edit" clave="'+data.user.Clave+'" onclick="edit(this);">Editar <i class="fas fa-edit"></i></button><button type="button" class="btn btn-success btn-sm change" clave="'+data.user.Clave+'" onclick="changePassword(this);">Cambiar Contraseña <i class="fas fa-key"></i></button><button type="button" class="btn btn-danger delete" clave="'+data.user.Clave+'" onclick="deleted(this);">Eliminar<i class="fas fa-trash-alt"></i></button></div>'}])
                        .draw()
                        .nodes();                
                        // $( node ).find('td').eq(3).addClass('text-right');
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
        $('#contrasena').change(function() {
            var nombres=$('#contrasena').val();
            console.log(nombres);
            if(nombres!=""){
                if($('#contrasena').hasClass( 'is-invalid')==true){
                    $('#contrasena').removeClass('is-invalid');
                    $('#contrasena').addClass( 'is-valid');
                    $('#error_contrasena').hide();
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