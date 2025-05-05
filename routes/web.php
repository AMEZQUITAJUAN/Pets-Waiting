<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MascotasController;
use App\Http\Controllers\AdopcionesController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\PerdidoController;
use Illuminate\Support\Facades\Route;

// Ruta principal
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas para Adopción
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

// Ruta para login
Route::post('/login', [UsuariosController::class, 'login'])->name('login');

// Ruta para logout
Route::post('/logout', function () {
    auth()->logout();
    return redirect()->route('home')->with('success', 'Has cerrado sesión exitosamente.');
})->name('logout');

// Ruta para el dashboard de administrador
Route::get('/admin/dashboard', [UsuariosController::class, 'index'])->name('admin.dashboard');

// Ruta para porque adoptar
Route::get('/porque-adoptar', function () {
    return view('porquea');
})->name('porquea');

// Rutas para Perdidos (usando resource)
Route::resource('perdidos', PerdidoController::class);

Route::get('/frmadopcion/create', [AdopcionesController::class, 'create'])->name('adopcion.create'); // Muestra el formulario
Route::post('/frmadopcion/store', [AdopcionesController::class, 'store'])->name('adopcion.store'); // Procesa el formulario

Route::get('/frmadopcion', function () {
    return redirect()->route('adopcion.create');
});

Route::get('/frmadopcion/create/{mascota}', [AdopcionesController::class, 'create'])->name('frmadopcion.create');

Route::get('/adopciones/create/{mascota}', [AdopcionesController::class, 'create'])->name('adopcion.create');
