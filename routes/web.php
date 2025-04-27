<?php

use App\Http\Controllers\MascotasController;
use App\Http\Controllers\OrmController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;

// Ruta principal
Route::get('/', function () {
<<<<<<< HEAD
    return view('home'); // Página principal con el formulario
})->name('usuarios.create');

// Ruta de prueba
Route::get('prueba', function () {
    return view('home');
});

// Rutas para Mascotas
Route::get('mascotas', [MascotasController::class, 'index'])->name('mascotas.index'); // Mostrar lista de mascotas
Route::get('mascotas/create', [MascotasController::class, 'create'])->name('mascotas.create'); // Mostrar formulario de creación de mascota
Route::get('mascotas/{mascota}', [MascotasController::class, 'show'])->name('mascotas.show'); // Mostrar detalles de una mascota

// Rutas para Usuarios
Route::post('usuarios/store', [UsuariosController::class, 'store'])->name('usuarios.store'); // Guardar usuario
Route::get('usuarios', [UsuariosController::class, 'index'])->name('usuarios.index'); // Mostrar lista de usuarios
=======
    return view('home');// Página principal con el formulario
})->name('usuarios.create');


Route::get('/usuarios/create', [UsuariosController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios/store', [UsuariosController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');

 // Mostrar lista de usuarios
>>>>>>> 8deacc72ba314f336d96239c60cdfd7e9a0955df

// Ruta para consultas ORM
Route::get('/ormconsultas', [OrmController::class, 'consultas'])->name('orm.consultas');

