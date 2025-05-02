<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MascotasController;
use App\Http\Controllers\OrmController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;

// Ruta principal - solo mantén esta
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas para Usuario
Route::get('usuarios/create', [UsuariosController::class, 'create'])->name('usuarios.create');
Route::post('usuarios/store', [UsuariosController::class, 'store'])->name('usuarios.store');
Route::get('usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
Route::delete('usuarios/{id}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');

// Rutas para Mascotas
Route::resource('mascotas', MascotasController::class);

// Ruta para consultas ORM
Route::get('/ormconsultas', [OrmController::class, 'consultas'])->name('orm.consultas');
