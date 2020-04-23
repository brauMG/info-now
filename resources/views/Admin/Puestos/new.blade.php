<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nuevo Puesto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Puesto</label>
                        <input class="form-control" type="text" id="puesto" name="puesto">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token"/>
                        <div class="invalid-feedback" id="error_puesto" style="display: none;"></div>
                    </div>
                </div>
                <div class="col-12 col-md-4" style="display: none;">
                    <div class="form-group">
                        <label>Compañía</label>
                        <select class="form-control" name="compania" id="compania">
                            @foreach ($company as $item)
                                <option value="{{$item->Clave}}">{{$item->Descripcion}}</option>
                            @endforeach
                        </select>                        
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
        $('#compania').val('{{Auth::user()->Clave_Compania}}');
        $('#save').click(function(){
            var error=false;
            var table=$('#table').DataTable();
            var puesto=$('#puesto').val();
            var compania=$('#compania').val();
            var companiaText=$('#compania option:selected').text();
            var token=$('#_token').val();
            if(puesto==""){
                $('#puesto').addClass('is-invalid');
                $('#error_puesto').html('*Ingresa un puesto');
                $('#error_puesto').show();
                error=true;
            }
            if(error==false){
                $.post('{{ url('/Admin/Puestos/Create')}}',{_token:token,puesto:puesto,compania:compania},function(data ){                             
                    $('#Alert').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Listo!</strong> Se agregó correctamente.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');                                              
                    var node=table.rows
                    .add([{ 0:data.puesto.Clave, 1:companiaText, 2:puesto, 3:'<div class="btn-group" role="group" aria-label="Basic example"><button type="button" class="btn btn-primary edit" clave="'+data.puesto.Clave+'" onclick="edit(this);">Editar <i class="fas fa-edit"></i></button><button type="button" class="btn btn-danger delete" clave="'+data.puesto.Clave+'" onclick="deleted(this);">Eliminar<i class="fas fa-trash-alt"></i></button></div>'}])
                    .draw()
                    .nodes();
                    $(node).attr('id',data.puesto.Clave);
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
                                 
        });

        $('#puesto').change(function() {
            var nombres=$('#puesto').val();
            console.log(nombres);
            if(nombres!=""){
                if($('#puesto').hasClass( 'is-invalid')==true){
                    $('#puesto').removeClass('is-invalid');
                    $('#puesto').addClass( 'is-valid');
                    $('#error_puesto').hide();
                }
            }
        });
    });
</script>