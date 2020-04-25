<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nueva Compañia</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-6 col-md-4">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input class="form-control" type="text" id="descripcion" name="descripcion">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token"/>
                        <div class="invalid-feedback" id="error_nombre" style="display: none;"></div>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="form-group">
                        <label>Dominio</label>
                        <input class="form-control" type="text" id="dominio" name="dominio">
                        <div class="invalid-feedback" id="error_dominio" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
            <button type="button" class="btn btn-primary" id="save" onclick="SaveData();"><i class="fas fa-save"></i> Guardar</button>
        </div>
    </div>
</div>
<script>
    function SaveData() {
        var error=false;
        var descripcion=$('#descripcion').val();
        var dominio=$('#dominio').val();
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
        var token=$('#_token').val();
        if(error==false){
            $.post('{{ url('/Admin/Compania/Create')}}',{_token:token,descripcion:descripcion,dominio:dominio},function(data ){
                $('#Alert').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Listo!</strong> Se agregó correctamente<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                var node=table.rows
                    .add( [{0:data.company.Clave,1:descripcion,2:dominio,3:'<div class="btn-group" role="group" aria-label="Basic example"><button type="button" class="btn btn-primary edit" clave="'+data.company.Clave+'" onclick="edit(this);">Editar <i class="fas fa-edit"></i></button><button type="button" class="btn btn-danger delete" clave="'+data.company.Clave+'" onclick="deleted(this);">Eliminar<i class="fas fa-trash-alt"></i></button></div>'}])
                    .draw()
                    .nodes();
                $( node ).find('td').eq(3).addClass('text-right');
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

    }
    $(document).ready(function(){
        var table=$('#table').DataTable();
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
