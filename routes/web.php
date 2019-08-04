<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::resource('clientes', 'ClienteController');
Route::get('/clientes', 'ClienteController@create');//->name('crear');
Route::post('/clientes', 'ClienteController@store')->name('clientes.store');
Route::get('/clientes/show', 'ClienteController@ShowClientelist')->name('cliente.mostrar');
