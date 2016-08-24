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
								<th>Usuario</th>
								<th>Nombre</th>
								<th>Apellido</th>
								<th>Tipo</th>
								<th>Accion</th>
							</tr>
						</thead>
						<tbody>
							@foreach($usuarios as $users)
								<tr>
									<th scope="row">{{ $users->id }}</th>
									<td>{{ $users->email }}</td>
									<td>{{ $users->name }}</td>
									<td>{{ $users->last_name }}</td>
									<td>
									  @if($users->type == "admin")
									  	<span class="label label-primary">{{ $users->type }}</span>
									  @else
									  	<span class="label label-success">{{ $users->type }}</span>
									  @endif
									</td>
									<td><a href="" class="btn btn-danger"></a> <a href="" class="btn btn-warning"></a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
					{!! $usuarios->render() !!}					
				</div>				
			</div>
		</div>	
	</div>
@endsection
