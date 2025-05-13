<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('frminicio');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        try {
            $usuario = Usuario::where('email', $credentials['email'])->first();

            if (!$usuario) {
                Log::warning('Intento de login: usuario no encontrado', ['email' => $credentials['email']]);
                return back()->withErrors([
                    'email' => 'No encontramos una cuenta con ese email.'
                ])->withInput($request->only('email'));
            }

            if (!$usuario->validatePassword($credentials['password'])) {
                Log::warning('Intento de login: contraseña incorrecta', ['email' => $credentials['email']]);
                return back()->withErrors([
                    'password' => 'La contraseña es incorrecta.'
                ])->withInput($request->only('email'));
            }

            Auth::login($usuario);
            $request->session()->regenerate();

            Log::info('Login exitoso', ['usuario' => $usuario->id]);

            // Redirigir según el rol del usuario
            if ($usuario->rol === 'admin') {
                return redirect()->route('mascotas.index'); // Redirige a mascotas.index para administradores
            }

            return redirect()->route('home'); // Redirige a home para usuarios normales

        } catch (\Exception $e) {
            Log::error('Error en login: ' . $e->getMessage());
            return back()->withErrors([
                'error' => 'Ocurrió un error al intentar iniciar sesión.'
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Has cerrado sesión correctamente');
    }

    public function register(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:usuarios',
                'password' => 'required|string|min:6|confirmed',
            ]);

            \Log::info('Datos de registro recibidos', ['email' => $request->email]);

            $usuario = Usuario::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'rol' => 'usuario', // Por defecto es usuario normal
            ]);

            // Login automático después del registro
            Auth::login($usuario);

            return redirect()->route('home')
                ->with('success', '¡Usuario registrado exitosamente!');
        } catch (\Exception $e) {
            \Log::error('Error en registro: ' . $e->getMessage());
            return back()
                ->withInput()
                ->withErrors(['email' => 'Error al registrar el usuario. ' . $e->getMessage()]);
        }
    }
}
