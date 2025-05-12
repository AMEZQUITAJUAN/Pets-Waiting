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
Route::get('/mascotas', [MascotasController::class, 'index'])->name('mascotas.index');

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

// Rutas para mascotas perdidas
Route::get('/perdidos', [PerdidosController::class, 'index'])->name('perdidos.index');
Route::get('/perdidos/create', [PerdidosController::class, 'create'])->name('perdidos.create');
Route::post('/perdidos', [PerdidosController::class, 'store'])->name('perdidos.store');
Route::get('/perdidos/{perdido}', [PerdidosController::class, 'show'])->name('perdidos.show');
Route::get('/perdidos/{perdido}/edit', [PerdidosController::class, 'edit'])->name('perdidos.edit');
Route::put('/perdidos/{perdido}', [PerdidosController::class, 'update'])->name('perdidos.update');
Route::delete('/perdidos/{perdido}', [PerdidosController::class, 'destroy'])->name('perdidos.destroy');

// Rutas protegidas
Route::middleware(['auth'])->group(function () {
    Route::get('/mascotas/create', [MascotasController::class, 'create'])->name('mascotas.create');
    Route::get('/adopciones/{mascota}/create', [AdopcionesController::class, 'create'])->name('adopciones.create');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('mascotas.index', MascotasController::class);
    Route::get('/admin/perdidos', [PerdidosController::class, 'adminIndex'])->name('admin.perdidos');
});
