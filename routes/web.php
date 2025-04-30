<?php

use App\Http\Controllers\MascotasController;
use App\Http\Controllers\OrmController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;

// Ruta principal
Route::get('/', function () {
    return view('home'); // Página principal
})->name('home');

// Ruta para mostrar el formulario de registro
Route::get('usuarios/create', [UsuariosController::class, 'create'])->name('usuarios.create');

// Ruta de prueba
Route::get('prueba', function () {
    return view('home');
});

// Rutas para Mascotas
Route::resource('mascotas', MascotasController::class);

// Rutas para Usuario
Route::post('usuarios/store', [UsuariosController::class, 'store'])->name('usuarios.store'); // Guardar usuario
Route::get('usuarios', [UsuariosController::class, 'index'])->name('usuarios.index'); // Mostrar lista de usuarios
Route::delete('usuarios/{id}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy'); // Eliminar usuario

// Ruta para consultas ORM
Route::get('/ormconsultas', [OrmController::class, 'consultas'])->name('orm.consultas');

