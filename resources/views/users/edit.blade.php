@extends('layout')

@section('contenido')

	<h1>Editar usuario</h1>
	@if(session()->has('info'))
		<div class="alert alert-success">{{ session('info') }}</div>
	@endif


<form method="POST" action="{{route('usuarios.update', $u->id)}}">
	{!! method_field('PUT') !!}
	{!! csrf_field() !!}
	<p><label for="name">
		Nombre
		<input class="form-control" type="text" name="name" value="{{ $u->name }}">
		{!! $errors->first('name','<span class=error>:message</span>') !!}
	</label>
	</p>

	<p><label for="email">
		E-mail
		<input class="form-control" type="email" name="email" value="{{ $u->email}}">
		{!! $errors->first('email','<span class=error>:message</span>') !!}
	</label></p>
	<p><input class="btn btn-primary" type="submit" value="Enviar"></p>
	<div class="checkbox">
		@foreach ($roles as $id => $name)
			<label>
				<input type="checkbox" value="{{ $id }}" {{ $u->roles->pluck('id')->contains($id) ? 'checked' : ''}} name="roles[]">
				{{ $name }}
			</label>
		@endforeach

	</div>
</form>

@stop