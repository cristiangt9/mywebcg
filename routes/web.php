<?php

//App\User::create([
//
//		'name' => 'jhuliana',
//		'email' => 'jhuliana@gmail.com',
//		'password' => bcrypt('123456'),
//]);

//App\Role::create([
//
//		'name' => 'admin',
//		'display_name' => 'Administrador del sitio',
//		'description' => 'Tiene todos los permisos',
//]);

//App\Role::create([
//
//		'name' => 'mod',
//		'display_name' => 'Moderador de comentarios',
//		'description' => 'Tiene los permisos para moderar',
//]);

//App\Role::create([
//
//		'name' => 'comen',
//		'display_name' => 'Generador de comentarios',
//		'description' => 'Tiene los permisos para comentar',
//]);

DB::listen(function($query){
	//echo "<pre>$query->sql</pre>";
});

Route::get('/', ['as' => 'home', 'uses' => 'PagesController@home']);


Route::get('login','Auth\LoginController@showLoginForm');

Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);

Route::get('logout',['as' => 'logout','uses' => 'Auth\LoginController@logout']);

Route::post('login','Auth\LoginController@login');

Route::resource('mensajes', 'MessagesController');

Route::resource('usuarios', 'UsersController');

//Route::get('mensajes',['as' => 'messages.index', 'uses' => 'MessagesController@index']);

//Route::get('mensajes/create',['as' => 'messages.create', 'uses' => 'MessagesController@create']);
//Route::post('mensajes',['as' => 'messages.store', 'uses' => 'MessagesController@store']);

//Route::get('mensajes/{id}',['as' => 'messages.show', 'uses' => 'MessagesController@show']);

//Route::get('mensajes/{id}/edit', ['as' => 'messages.edit', 'uses' => 'MessagesController@edit']);

//Route::put('mensajes/{id}',['as' => 'messages.update', 'uses' => 'MessagesController@update']);

//Route::delete('mensajes/{id}',['as' => 'messages.destroy', 'uses' => 'MessagesController@destroy']);




//Route::get('/', 'HomeController@index')->name('home');
