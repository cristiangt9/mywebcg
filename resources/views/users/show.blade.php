@extends('layout')

@section('contenido')
	
	<h1>{{ $u->name }}</h1>
	<table class="table">
		
		<tr>
			<th>Nombre:</th>
			<td>{{ $u->name }}</td>
		</tr>
		<tr>
			<th>Email:</th>
			<td>{{ $u->email }}</td>
		</tr>
		<tr>
			<th>Nombre:</th>
			<td>{{ $u->roles->pluck('display_name')->implode(', ') }}			
			</td>
		</tr>
	</table>
<div>
	@can('edit',$u)
		<a href="{{route('usuarios.edit', $u->id)}}" class="btn btn-info">Editar</a>
	@endcan
	@can('destroy',$u)
		<a href="{{route('usuarios.destroy', $u->id)}}" class="btn btn-danger">Eliminar</a>
	@endcan
	<a style="display:inline" href="{{route('home')}}" class="btn btn-secondary">Volver</a></div>
@stop