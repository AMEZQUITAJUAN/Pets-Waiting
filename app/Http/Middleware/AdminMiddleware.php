<?php
// filepath: c:\xampp\htdocs\Pets-Waiting\app\Http\Middleware\AdminMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->rol === 'admin') {
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'No tienes permiso para acceder a esta página.');
    }
}