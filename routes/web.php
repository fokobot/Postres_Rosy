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