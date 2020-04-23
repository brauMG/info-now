<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nuevo Estado</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Estado</label>
                        <input class="form-control" type="text" id="status" name="status">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token"/>
                        <div class="invalid-feedback" id="error_status" style="display: none;"></div>
                    </div>
                </div>                
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar<i class="fas fa-times"></i></button>
            <button type="button" class="btn btn-primary" id="save">Guardar<i class="fas fa-save"></i></button>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        
        $('#save').click(function(){
            var error=false;
            var table=$('#table').DataTable();
            var status=$('#status').val();            
            var token=$('#_token').val();
            if(status==""){
                $('#status').addClass('is-invalid');
                $('#error_status').html('*Ingresa un estado');
                $('#error_status').show();
                error=true;
            }
            if(error==false)
            {
                $.post('{{ url('/Admin/Status/Create')}}',{_token:token,status:status},function(data ){
                    $('#Alert').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Listo!</strong> Se agregó correctamente.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');                                              
                    var node=table.rows
                    .add([{ 0:data.status.Clave,  1:status, 2:'<div class="btn-group" role="group" aria-label="Basic example"><button type="button" class="btn btn-primary edit" clave="'+data.status.Clave+'" onclick="edit(this);">Editar <i class="fas fa-edit"></i></button><button type="button" class="btn btn-danger delete" clave="'+data.status.Clave+'" onclick="deleted(this);">Eliminar<i class="fas fa-trash-alt"></i></button></div>'}])
                    .draw()
                    .nodes();                
                    $( node ).find('td').eq(2).addClass('text-right');
                    $( node ).attr('id',data.status.Clave);
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
        $('#status').change(function() {
            var nombres=$('#status').val();
            console.log(nombres);
            if(nombres!=""){
                if($('#status').hasClass( 'is-invalid')==true){
                    $('#status').removeClass('is-invalid');
                    $('#status').addClass( 'is-valid');
                    $('#error_status').hide();
                }
            }
        });
    });
</script>