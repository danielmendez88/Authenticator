<div class="container">
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="form-group">
							{!! Form::label('name', 'Nombre', ['class' => 'col-sm-2 control-label']); !!}
							<div class="col-sm-10">
								{!! Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Project Name']) !!}
							</div>
					</div>

					<div class="form-group">
							{!! Form::label('name', 'Descripcion', ['class' => 'col-sm-2 control-label']); !!}
							<div class="col-sm-10">
								{!! Form::textarea('descripcion', '', ['rows' => '3', 'cols' => '3', 'class' => 'form-control', 'placeholder' => 'descripcion']) !!}
							</div>
					</div>

					<div class="form-group">
							{!! Form::label('name', 'Fecha de Proyecto', ['class' => 'col-sm-2 control-label']); !!}
							<div class="col-sm-10">
								{!! Form::text('duedate', '', ['id' => 'datepicker', 'class' => 'form-control', 'placeholder' => 'Project Due date']) !!}
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>