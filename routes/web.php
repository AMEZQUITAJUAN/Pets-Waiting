<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrmController;
use App\Http\Controllers\UsuariosController;
Route::get('/', function () {
    return view('home'); // Página principal con el formulario
})->name('usuarios.create'); // Nombrar la ruta para usarla en enlaces




Route::get('prueba', function () {
    return view('home');
});



Route::post('usuarios/store', [UsuariosController::class, 'store'])->name('usuarios.store'); // Guardar usuario

Route::get('usuarios', [UsuariosController::class, 'index'])->name('usuarios.index'); // Mostrar lista de usuarios

Route::get('/ormconsultas',[OrmController::class,'consultas']);

