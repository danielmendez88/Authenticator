|<div class="modal fade" id="webcamera" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
		<!--Abrir el formulario-->
			{!! Form::open(['method' => 'POST', 'action' => 'UsersController@login', 'class' => 'form-horizontal', 'role' => 'form']) !!}

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Leer Camara</h4>
			</div>
			<div class="modal-body">
				@include('forms.formpopup')
			</div>
			<div class="modal-footer">
				<button type="button" id="close_btn" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
			</div>
			{!! Form::close() !!}
			<!--cerrar el formulario-->

		</div>
	</div>
</div>