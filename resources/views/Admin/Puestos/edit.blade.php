<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Actualizar Compañía</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Puesto</label>
                        <input class="form-control" type="text" id="puesto" name="puesto" value="{{$puesto->Puesto}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token"/>
                        <input type="hidden" name="clave" value="{{$puesto->Clave}}" id="clave"/>
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
            <button type="button" class="btn btn-primary" id="update">Actualizar<i class="fas fa-edit"></i></button>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        var table=$('#table').DataTable();
        $('#compania').val('{{$puesto->Clave_Compania}}');
        $('#update').click(function(){
            var error=false;
            var puesto=$('#puesto').val();
            var compania =$('#compania').val();
            var companiaText=$('#compania option:selected').text();
            var clave=$('#clave').val();
            var token=$('#_token').val();
            var tr=  $('tr#'+clave);
            if(puesto==""){
                $('#puesto').addClass('is-invalid');
                $('#error_puesto').html('*Ingresa un puesto');
                $('#error_puesto').show();
                error=true;
            }
            if(error==false){
                $.post('{{ url('/Admin/Puestos/Update')}}',{_token:token,puesto:puesto,clave:clave,compania:compania},function(result ){                             
                    $('#Alert').html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Listo!</strong> Se actualizó correctamentebutton type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    var data=table.row(tr)
                    .data();
                    data[2]=puesto;
                    data[1]=companiaText;
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