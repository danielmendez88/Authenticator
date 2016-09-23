@extends('layouts.app')

@section('title', 'Panel de Administración')

@section('content')
	<div class="container bs-docs-container">
		<div class="row">
			<hr>
			<div class="col-md-10" role="main">
				<div class="bs-docs-section table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Cuenta</th>
								<th>Dirección Ip</th>
								<th>Fecha de Login</th>
								<th>Log</th>
								<th>Accion</th>
							</tr>
						</thead>
						<tbody>
							@foreach($bitacora as $binnacle)
								<tr>
									<th scope="row">{{ $binnacle->id }}</th>
									<td>{{ $binnacle->user_acount }}</td>
									<td>{{ $binnacle->myip }}</td>
									<td>{{ $binnacle->created_at }}</td>
									<td>
									  @if($binnacle->log_types == "1")
									  	<span class="label label-success">{{ $binnacle->logs }}</span>
									  @else
									  	<span class="label label-warning">{{ $binnacle->logs }}</span>
									  @endif
									</td>
									<td><a href="" class="btn btn-danger">Delete</a> <a href="" class="btn btn-warning">Edit</a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
					{!! $bitacora->render() !!}					
				</div>				
			</div>
		</div>	
	</div>
@endsection
