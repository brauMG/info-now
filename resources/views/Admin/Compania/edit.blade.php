<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Actualizar compañia</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-6 col-md-4">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input class="form-control" type="text" id="descripcion" name="descripcion" value="{{$company->Descripcion}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token"/>
                        <input type="hidden" name="clave" value="{{$company->Clave}}" id="clave"/>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="form-group">
                        <label>Dominio</label>
                        <input class="form-control" type="text" id="dominio" name="dominio" value="{{$company->Dominio}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token"/>
                        <input type="hidden" name="clave" value="{{$company->Clave}}" id="clave"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
            <button type="button" class="btn btn-primary" id="update"><i class="fas fa-edit"></i> Actualizar</button>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        var table=$('#table').DataTable();
        $('#update').click(function(){
            var error=false;
            var descripcion=$('#descripcion').val();
            var dominio=$('#dominio').val();
            var clave=$('#clave').val();
            var token=$('#_token').val();
            var tr=  $('tr#'+clave);
            if(descripcion==""){
                $('#descripcion').addClass('is-invalid');
                $('#error_nombre').html('*Ingresa un nombre');
                $('#error_nombre').show();
                error=true;
            }
            if(dominio==""){
                $('#dominio').addClass('is-invalid');
                $('#error_dominio').html('*Ingresa un dominio');
                $('#error_dominio').show();
                error=true;
            }

            if(error==false){
                $.post('{{ url('/Admin/Compania/Update')}}',{_token:token,descripcion:descripcion,dominio:dominio,clave:clave},function(data ){
                    $('#Alert').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Listo!</strong> Se actualizó correctamente, se refrescara la página en 5 segundos.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    $('#myModal').modal('hide');
                    setTimeout(function() {
                        location.reload();
                    }, 5000);
                    var data=table.row(tr)
                    .data();
                    data[1]=descripcion
                    data[2]=dominio
                    table
                    .row( tr )
                    .data( data )
                    .draw();
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

        $('#descripcion').change(function() {
            var nombres=$('#descripcion').val();
            console.log(nombres);
            if(nombres!=""){
                if($('#descripcion').hasClass( 'is-invalid')==true){
                    $('#descripcion').removeClass('is-invalid');
                    $('#descripcion').addClass( 'is-valid');
                    $('#error_nombre').hide();
                }
            }
        });
        $('#dominio').change(function() {
            var nombres=$('#dominio').val();
            console.log(nombres);
            if(nombres!=""){
                if($('#dominio').hasClass( 'is-invalid')==true){
                    $('#dominio').removeClass('is-invalid');
                    $('#dominio').addClass( 'is-valid');
                    $('#error_dominio').hide();
                }
            }
        });

    });
</script>
