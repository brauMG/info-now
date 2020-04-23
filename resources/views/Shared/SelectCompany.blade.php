<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Seleciona compañia</h5>            
        </div>
        <div class="modal-body">
        	<div class="row">
        		<div class="col-12 col-md-6">
        			<label>Compañia</label>
        			<select class="form-control" id="company">
        				@foreach($companias as $compania)
        					<option value="{{$compania->Clave}}">{{$compania->Descripcion}}</option>
        				@endforeach
        			</select>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token"/>
        		</div>
        	</div>
        </div>
        <div class="modal-footer">            
            <button type="button" class="btn btn-primary" id="save">Selecciona compañia</button>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#save').click(function(){
            var company=$('#company').val();
            var token=$('#_token').val();
            $.get('{{ url('/Admin/Usuarios/ChangeCompany')}}/'+company,{_token:token},function(data ){
                location.reload(); 
            });
        });

    });
</script>