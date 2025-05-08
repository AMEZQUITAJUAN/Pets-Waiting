<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MascotasController;
use App\Http\Controllers\AdopcionesController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\PerdidosController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Ruta principal
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas para Adopción
Route::get('/adopciones/{mascota}/create', [AdopcionesController::class, 'create'])->name('adopciones.create');
Route::post('/adopciones', [AdopcionesController::class, 'store'])->name('adopciones.store');
Route::get('/adopcion', [AdopcionesController::class, 'index'])->name('adopcion');

// Rutas para Usuario
Route::get('usuarios/create', [UsuariosController::class, 'create'])->name('usuarios.create');
Route::post('usuarios/store', [UsuariosController::class, 'store'])->name('usuarios.store');
Route::get('usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
Route::delete('usuarios/{id}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');

// Rutas para Mascotas
Route::resource('mascotas', MascotasController::class);

// Ruta para formulario de inicio
Route::get('/frminicio', [UsuariosController::class, 'showLoginForm'])->name('frminicio');

// Rutas para autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Ruta para el dashboard de administrador
Route::get('/admin/dashboard', [UsuariosController::class, 'index'])->name('admin.dashboard');

// Rutas públicas adicionales
Route::get('/porque-adoptar', function () {
    return view('porquea');
})->name('porquea');

// Rutas para Perdidos
Route::middleware(['auth'])->group(function () {
    Route::resource('perdidos', PerdidosController::class);
});
