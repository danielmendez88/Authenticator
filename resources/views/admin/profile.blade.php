@extends('layouts.app')

@section('title', 'Token del usuario')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Token</div>
					<div class="panel-body">
						{!! Form::open(['class' => 'form-horizontal', 'method' => 'post', 'action' => 'UsersController@login'])!!}
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<h1>

										{{ $token_number }}
									</h1>									
								</div>
							</div>
							<div class="form-group{{ $errors->has('token') ? ' has-error' : '' }}">
								{!! Form::label('name', 'Ingrese la Clave', ['class' => 'col-md-4 control-label']); !!}
								<div class="col-md-6">
									{!! Form::text('token', '',['class' => 'form-control']); !!}	
	                                @if ($errors->has('token'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('token') }}</strong>
	                                    </span>
	                                @endif
								</div>
							</div>
							<div class="form-group">
	                            <div class="col-md-6 col-md-offset-4">
	                                {!! Form::submit('Ingresar', ['class' => 'btn btn-success']); !!}
	                            </div>
                       		 </div>
                       		 {!! Form::hidden('id', $id); !!}
                       		 {!! Form::hidden('contrasena', $password); !!}
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection