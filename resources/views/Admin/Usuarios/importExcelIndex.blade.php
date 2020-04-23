@section('title', 'Usuarios')
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Importar Usuarios</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <form style="margin-top: 15px;padding: 10px;" class="form-horizontal" method="post" enctype="multipart/form-data" action="/Admin/Usuarios/importData">
                              {{ csrf_field() }}
                            <input type="file" name="import_file" />             
                            <button class="btn btn-primary" id="importar" type="submit">Importar Archivo</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <i class="fas fa-times"></i></button>
        </div>
    </div>
</div>
<script type="text/javascript">
     $(document).ready(function(){
         
    });
</script>
