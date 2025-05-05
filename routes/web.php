<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MascotasController;
use App\Http\Controllers\AdopcionesController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\PerdidoController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Ruta principal
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas para Adopción
Route::get('/adopcion', [AdopcionesController::class, 'index'])->name('adopcion');

// Rutas para Usuario
Route::get('/registro', [UsuariosController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UsuariosController::class, 'store'])->name('usuarios.store');

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas
Route::middleware(['auth'])->group(function () {
    Route::resource('mascotas', MascotasController::class);
    Route::get('usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
    Route::delete('usuarios/{id}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');
    Route::get('/admin/dashboard', [UsuariosController::class, 'index'])->name('admin.dashboard');
});

// Rutas públicas adicionales
Route::get('/porque-adoptar', function () {
    return view('porquea');
})->name('porquea');

Route::resource('perdidos', PerdidoController::class);
