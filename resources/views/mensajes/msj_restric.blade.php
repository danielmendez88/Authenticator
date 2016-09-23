@extends('layouts.app')

@section('title', 'Mensaje de Restricción')

@section('content')
	<!--aqui inicia el contenido de la vista-->
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Advertencia</div>

                <div class="panel-body">
					<div class="media">
					  <div class="media-left">
					  </div>
					  <div class="media-body">
					    <h4 class="media-heading">
					    	<div class="alert alert-warning" role="alert">{{ $msj }}</div>
					    </h4>
					  </div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection