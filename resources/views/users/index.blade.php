@extends('layout')

@section('contenido')

	<h1> Todos los Usuarios</h1>
	<div class="container-fluid"><a href={{ route('usuarios.create')}} class="btn btn-success">Agregar</a></div>
	
	<br>
	<br>

	<table class="table">
		<thead>
			<tr>
			<th>Id</th>
			<th>Nombre</th>
			<th>Email</th>
			<th>Roles</th>
			<th>Notas</th>
			<th>Etiquetas</th>
			<th>Acciones</th>
		</tr>
		</thead>
		<tbody>
			@foreach ($users as $user)
				<tr>
					<td>{{ $user->id }}</td>
					<td><a href="{{ route('usuarios.show', $user->id) }}">{{ $user->name }}</a></td>
					<td>{{ $user->email }}</td>
					<td>
						{{ $user->roles->pluck('display_name')->implode(', ') }}
					</td>
					<td>@if($user->note != '') 
							{{ $user->note->body }}
						@else
							<em>-No tiene notas-</em>
						@endif
					</td>
					<td>@if($user->tags->pluck('name')->implode(', ') != '') 
							{{ $user->tags->pluck('name')->implode(', ') }}
						@else
							<em>-No tiene etiquetas-</em>
						@endif
					</td>
					<td><a class="btn btn-info btn-sm" href="{{route('usuarios.edit',$user->id)}}">Editar</a>
						<form style="display:inline" method="POST" action="{{ route('usuarios.destroy', $user->id)}}"> 
							{!! method_field('DELETE') !!}
							{!! csrf_field() !!}

							<button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
						</form>
					</td>
				</tr>
			@endforeach
			{!! $users->appends(request()->query())->links('pagination::bootstrap-4-u') !!}
		</tbody>

	</table>
	<br>
	<br>

@stop