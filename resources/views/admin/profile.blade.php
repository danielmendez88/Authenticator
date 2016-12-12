@extends('layouts.app')

@section('title', 'Token del usuario')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Token &nbsp;

						<!--navegación-->
						
		 					<button title="Reproducir" class="btn btn-success btn-sm" id="play" type="button" data-toggle="tooltip">
		 							<span class="glyphicon glyphicon-play"></span>
		 					</button>
		                    <button title="Pausar" class="btn btn-warning btn-sm" id="pause" type="button" data-toggle="tooltip">
		                    		<span class="glyphicon glyphicon-pause"></span>
		                    </button>
		                    <button title="Detener Transmisión" class="btn btn-danger btn-sm" id="stop" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-stop"></span></button>	
					

					</div>
					<div class="panel-body">
				<!--canvas-->
						<div class="col-md-6">
							<div class="well" width="320" height="240" style="position: relative; display: inline-block;">
			                    <canvas width="320" height="240" id="webcodecam-canvas"></canvas>
			                    <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
			                    <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
			                    <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
			                    <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>							
							</div>
							<p id="scanned-QR"></p>
						</div>

				<!--canvas End-->
						<div class="col-md-6">

							{!! Form::open(['class' => 'form-horizontal', 'method' => 'post', 'action' => 'UsersController@login', 'id' => 'formToken'])!!}
								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<h3 id="QR-TAG">

											{{ $token_number }}
										</h3>									
									</div>
								</div>
								<div class="form-group{{ $errors->has('token') ? ' has-error' : '' }}">
									{!! Form::label('name', 'Token', ['class' => 'col-md-4 control-label']); !!}
									<div class="col-md-6">
										{!! Form::text('token', '',['class' => 'form-control', 'id' => 'TokenId']); !!}	
		                                @if ($errors->has('token'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('token') }}</strong>
		                                    </span>
		                                @endif
									</div>
								</div>
								<!--<div class="form-group">
		                            <div class="col-md-6 col-md-offset-4">
		                                {!! Form::submit('Ingresar', ['class' => 'btn btn-success']); !!}
		                            </div>
	                       		 </div>-->
	                       		 {!! Form::hidden('id', $id); !!}
	                       		 {!! Form::hidden('contrasena', $password); !!}
							{!! Form::close() !!}
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!--scripts para el correcto funcionamiento del scanner QR-->
<script src="{{ asset('/js/jquery.js')}}" type="text/javascript"></script>	
<script src="{{ asset('/js/qrcodelib.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/webcodecamjquery.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/mainjquery.js') }}" type="text/javascript"></script>	
<!--scripts para el correcto funcionamiento del scanner QR END-->	
@endsection