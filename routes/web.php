<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('index');
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

Route::group(['prefix' => 'gastos', 'as' => 'gastos.'], function() {
	Route::get('/', 'GastoController@index')->name('index');
	Route::post('/', 'GastoController@store')->name('store');
	Route::get('/new', 'GastoController@create')->name('new');
  Route::get('/{gasto}/edit', 'GastoController@edit')->name('edit');
  Route::put('/{gasto}/edit', 'GastoController@update')->name('put');
});