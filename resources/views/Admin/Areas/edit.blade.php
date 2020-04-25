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
                        <label>Nombre</label>
                        <input class="form-control" type="text" id="descripcion" name="descripcion" value="{{$area->Descripcion}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token"/>
                        <input type="hidden" name="clave" value="{{$area->Clave}}" id="clave"/>
                        <div class="invalid-feedback" id="error_descripcion" style="display: none;"></div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group" style="display: none;">
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
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
            <button type="button" class="btn btn-primary" id="update"><i class="fas fa-edit"></i> Actualizar</button>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#compania').val('{{Auth::user()->Clave_Compania}}');
        var table=$('#table').DataTable();
        $('#update').click(function(){
            var error=false;
            var descripcion=$('#descripcion').val();
            var compania =$('#compania').val();
            var companiaText=$('#compania option:selected').text();
            var clave=$('#clave').val();
            var token=$('#_token').val();
            var tr=  $('tr#'+clave);
            var token=$('#_token').val();
            if(descripcion==""){
                $('#descripcion').addClass('is-invalid');
                $('#error_descripcion').html('*Ingresa una descripcion');
                $('#error_descripcion').show();
                error=true;
            }
            if(error==false){
                $.post('{{ url('/Admin/Areas/Update')}}',{_token:token,descripcion:descripcion,clave:clave,compania:compania},function(data ){
                    $('#Alert').html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Listo!</strong> Se actualizó correctamente.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    var data=table.row(tr)
                    .data();
                    data[2]=descripcion;
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

        $('#descripcion').change(function() {
            var nombres=$('#descripcion').val();
            console.log(nombres);
            if(nombres!=""){
                if($('#descripcion').hasClass( 'is-invalid')==true){
                    $('#descripcion').removeClass('is-invalid');
                    $('#descripcion').addClass( 'is-valid');
                    $('#error_descripcion').hide();
                }
            }
        });
    });
</script>
