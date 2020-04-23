<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Actualizar contraseña</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token"/>
                <input type="hidden" name="clave" value="{{ $usuario->Clave}}" id="clave"/>                                   
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Contraseña</label>
                        <input class="form-control" type="password" id="contrasena" name="contrasena">                                
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
        
        $('#update').click(function(){
            
            var contrasena=$('#contrasena').val();            
            
            var clave=$('#clave').val();
            var token=$('#_token').val();
            var tr=  $('tr#'+clave);
            $.post('{{ url('/Admin/Usuarios/UpdatePassword')}}',{_token:token,clave:clave,contrasena:contrasena},function(data ){                             
                $('#Alert').html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Listo!</strong> Se actualizo correctamente<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                /*var info=table.row(tr)
                .data();
                info[1]=companiaText;
                info[2]=data.usuario.Iniciales;
                info[3]=nombres;
                info[4]=correo;
                info[5]=areaText;
                info[6]=puestoText;
                info[7]=rolText;
                
                table
                .row( tr )
                .data( info )
                .draw();*/
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