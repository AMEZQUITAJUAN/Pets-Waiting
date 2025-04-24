<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrmController;
use App\Http\Controllers\UsuariosController;
Route::get('/', function () {
    return view('formulario ');// Página principal con el formulario
})->name('usuarios.create');


Route::get('/usuarios/create', [UsuariosController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios/store', [UsuariosController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');

 // Mostrar lista de usuarios

Route::get('/ormconsultas',[OrmController::class,'consultas']);

