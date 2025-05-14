<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MascotasController;
use App\Http\Controllers\AdopcionesController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\PerdidosController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificacionesController;
use Illuminate\Support\Facades\Route;

// Ruta principal
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas públicas
Route::get('/adopcion', [MascotasController::class, 'adopcionIndex'])->name('adopcion');

// Rutas para Adopción
Route::get('/adopciones/{mascota}/create', [AdopcionesController::class, 'create'])->name('adopciones.create');
Route::post('/adopciones', [AdopcionesController::class, 'store'])->name('adopciones.store');

// Rutas para Usuario
Route::get('usuarios/create', [UsuariosController::class, 'create'])->name('usuarios.create');
Route::post('usuarios/store', [UsuariosController::class, 'store'])->name('usuarios.store');
Route::delete('usuarios/{id}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');

// Rutas para Mascotas
Route::resource('mascotas', MascotasController::class);
Route::get('/mascotas', [MascotasController::class, 'index'])->name('mascotas.index');
Route::get('/mascotas/{mascota}', [MascotasController::class, 'show'])->name('mascotas.show');

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
Route::post('/perdidos/{id}/encontrada', [PerdidosController::class, 'reportarEncontrada'])->name('perdidos.encontrada');

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    Route::get('/publicar-mascota', [MascotasController::class, 'create'])->name('mascotas.create');
    Route::post('/mascotas', [MascotasController::class, 'store'])->name('mascotas.store');
    Route::get('/mascotas/crear', [MascotasController::class, 'create'])->name('mascotas.create');

    // Rutas para notificaciones
    Route::get('/notificaciones', [NotificacionesController::class, 'index'])->name('notificaciones.index');
    Route::post('/notificaciones/{id}/marcar-leida', [NotificacionesController::class, 'marcarComoLeida'])->name('notificaciones.marcar-leida');
    Route::post('/notificaciones/marcar-todas', [NotificacionesController::class, 'marcarTodasComoLeidas'])->name('notificaciones.marcar-todas');
    Route::delete('/notificaciones/{id}', [NotificacionesController::class, 'eliminar'])->name('notificaciones.eliminar');
});

// Rutas protegidas por autenticación y rol de administrador
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('mascotas.index', MascotasController::class);
    Route::get('/admin/perdidos', [PerdidosController::class, 'adminIndex'])->name('admin.perdidos');
    Route::get('/admin/usuarios', [UsuariosController::class, 'adminIndex'])->name('usuarios_list');
    Route::delete('/admin/usuarios/{usuario}', [UsuariosController::class, 'adminDestroy'])->name('admin.usuarios.destroy');
    Route::get('/usuarios/lista', [UsuariosController::class, 'adminIndex'])->name('usuarios_list');
});
