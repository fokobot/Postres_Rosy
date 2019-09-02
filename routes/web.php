<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'clientes', 'as' => 'clientes.'], function() {
	Route::get('/', 'ClienteController@index')->name('index');
	Route::post('/', 'ClienteController@store')->name('store');
	Route::get('/new', 'ClienteController@create')->name('new');
  Route::get('/{cliente}/edit', 'ClienteController@edit')->name('edit');
  Route::put('/{cliente}/edit', 'ClienteController@update')->name('put');
});

Route::group(['prefix' => 'productos', 'as' => 'productos.'], function() {
	Route::get('/', 'ProductoController@index')->name('index');
	Route::post('/', 'ProductoController@store')->name('store');
	Route::get('/new', 'ProductoController@create')->name('new');
  Route::get('/{producto}/edit', 'ProductoController@edit')->name('edit');
  Route::put('/{producto}/edit', 'ProductoController@update')->name('put');
});

Route::group(['prefix' => 'trabajos', 'as' => 'trabajos.'], function() {
	Route::get('/', 'TrabajoController@index')->name('index');
	Route::post('/', 'TrabajoController@store')->name('store');
	Route::get('/new', 'TrabajoController@create')->name('new');
  Route::get('/{trabajo}/edit', 'TrabajoController@edit')->name('edit');
  Route::put('/{trabajo}/edit', 'TrabajoController@update')->name('put');
});

Route::group(['prefix' => 'gastos', 'as' => 'gastos.'], function() {
	Route::get('/', 'GastoController@index')->name('index');
	Route::post('/', 'GastoController@store')->name('store');
	Route::get('/new', 'GastoController@create')->name('new');
});

Route::group(['prefix' => 'ventas', 'as' => 'ventas.'], function() {
	Route::get('/', 'VentaController@index')->name('index');
	Route::post('/', 'VentaController@store')->name('store');
	Route::get('/new', 'VentaController@create')->name('create');
});
