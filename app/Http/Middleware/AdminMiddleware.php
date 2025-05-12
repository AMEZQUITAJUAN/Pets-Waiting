<?php
// filepath: c:\xampp\htdocs\Pets-Waiting\app\Http\Middleware\AdminMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Verifica si el usuario está autenticado y es admin
        if (Auth::check() && Auth::user()->rol === 'admin') {
            return $next($request);
        }

        // Si la ruta es para crear mascota, solo verifica autenticación
        if ($request->routeIs('mascotas.create') && Auth::check()) {
            return $next($request);
        }

        // Si no cumple los requisitos, redirige
        return redirect()->route('home')
            ->with('error', 'No tienes permiso para acceder a esta página.');
    }
}
