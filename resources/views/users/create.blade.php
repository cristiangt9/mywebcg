@extends('layout')

@section('contenido')

	<h1>Crear nuevo usuario</h1>
	@if(session()->has('info'))
		<div class="alert alert-success">{{ session('info') }}</div>
	@endif


<form method="POST" action="{{route('usuarios.store')}}">
	{!! csrf_field() !!}
	<p><label for="name">
		Nombre:
		<input class="form-control" type="text" name="name" value="{{old('name')}}">
		{!! $errors->first('name','<span class=error>:message</span>') !!}
	</label>
	</p>

	<p><label for="email">
		E-mail:
		<input class="form-control" type="email" name="email" value="{{old('email')}}">
		{!! $errors->first('email','<span class=error>:message</span>') !!}
	</label></p>
	<p><label for="password">
		Contraseña:
		<input class="form-control" type="password" name="password">
		{!! $errors->first('password','<span class=error>:message</span>') !!}
	</label></p>
		<p><label for="password_confirmation">
		Confirmar contraseña:
		<input class="form-control" type="password" name="password_confirmation">
		{!! $errors->first('password_confirmation','<span class=error>:message</span>') !!}
	</label></p>

	Roles:
	<div class="checkbox">
		@foreach ($roles as $id => $name)
			<label>
				<input type="checkbox" value="{{ $id }}" name="roles[]">
				{{ $name }}
			</label>
		@endforeach

	</div>
	{!! $errors->first('roles','<span class=error>:message</span>') !!}
	<p><input class="btn btn-primary" type="submit" value="Guardar"></p>
</form>

@stop