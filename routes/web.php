<?php

use Illuminate\Support\Facades\Route;

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
    return view('frm_usuario');

});

Route::get('prueba', function () {
    return view('usuarios');
});
Route::get('usuarios/create', 'UsuariosController@create')->name('usuarios.create');
Route::post('usuarios/store', 'UsuariosController@store')->name('usuarios.store');

