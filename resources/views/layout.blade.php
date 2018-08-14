	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="/css/app.css">
		<script src="/js/app.js"></script>
		<title>Mi sitio</title>
	</head>
	<body>

		<header>
			<?php function activeMenu($url){
				return request()->is($url) ? 'active' : '';
			}?>

		<nav class="navbar navbar-expand-lg navbar-light bg-light">

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item {{ activeMenu('/') }}">
		        <a class="nav-link" href="{{ route('home')}} ">Inicio</a>
		      </li>
		      <li class="nav-item {{ activeMenu('mensajes/create') }}">
		        <a class="nav-link" href="#">Contactos</a>
		      </li>
		      @if( auth()->check())
		      	<li class="nav-item {{ activeMenu('mensajes*') }}">
		        	<a class="nav-link" href="#">Mensajes</a>
		      	</li>
		      	@if(auth()->user()->hasRoles(['admin','comen']))
						<li class="nav-item {{ activeMenu('usuarios*') }}">
				        	<a class="nav-link" href="{{ route('usuarios.index')}} ">Usuarios</a>
				      	</li>
				@endif
		      @endif

		      
		     
		    </ul>
		    <form class="form-inline my-2 my-lg-0">

		    	<ul class="navbar-nav mr-auto">
			    	@if( auth()->check())
						
						<li class="nav-item dropdown {{ activeMenu('logout') }}">
				        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				          {{ auth()->user()->name }}
				        </a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
				          <a class="dropdown-item" href="{{ route('logout')}}">Cerrar sesión</a>
				          <a class="dropdown-item" href="/usuarios/{{ auth()->id()}}/edit">Editar mi cuenta</a>

				        </div>
				        
				      </li>
					      

					@endif
					@if(auth()->guest())
						<li class="nav-item {{ activeMenu('login') }}">
			        		<a class="nav-link" href="{{ route('login')}} ">Login</a>
			      		</li>
					@endif
				</ul>
				<ul class="navbar-nav mr-auto">
					<li class="nav-item ">
		        		<a class="nav-link" href="#"></a>
		      		</li>
		      		<li class="nav-item ">
		        		<a class="nav-link" href="#"></a>
		      		</li>
				</ul>

		    </form>
		  </div>
		
</nav>

		</header>
		<div class="conteiner col-12 modal-content">
			@yield('contenido')
		</div>
		
		<footer class="modal-footer">Copyrigh ® {{ date('Y') }} </footer>
				

	</body>
	</html>