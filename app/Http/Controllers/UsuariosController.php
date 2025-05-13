<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Http\Requests\StoreUsuario; // Asegúrate de importar la clase StoreUsuario
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UsuariosController extends Controller
{
    public function create()
    {
        return view('formulario'); // Cargar la vista del formulario
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'password' => 'required|string|min:6',
        ]);

        try {
            $usuario = Usuario::create([
                'nombre' => $request->nombre,
                'email' => $request->email,
                'password' => $request->password, // El mutador se encargará de hashear
                'rol' => 'user'
            ]);

            // Registrar el éxito
            Log::info('Usuario registrado exitosamente', ['email' => $usuario->email]);

            // Autenticar al usuario después del registro
            auth()->login($usuario);

            // Cambiar la redirección para ir a la página de adopción general
            return redirect()->route('adopcion')
                ->with('success', '¡Registro exitoso! Ahora puedes explorar las mascotas en adopción.');

        } catch (\Exception $e) {
            Log::error('Error al registrar usuario: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Error al registrar usuario'])
                        ->withInput($request->except('password'));
        }
    }

    public function showUsuarioWithMascotas($id) {
        $usuario = Usuario::with('mascotas')->find($id); // Reemplaza $id con el ID que necesites
        return view('usuarios.show', compact('usuario'));
    }

    public function destroy($id) {
        $usuario = Usuario::find($id);
        if ($usuario) {
            $usuario->delete();
            return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
        } else {
            return redirect()->route('usuarios.index')->with('error', 'Usuario no encontrado.');
        }
    }

    public function showLoginForm()
    {
        return view('frminicio'); // Asegúrate de que esta vista exista
    }

    public function login(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'rol' => 'required|in:admin,user',
        ]);

        // Verificar si el usuario existe
        $usuario = Usuario::where('email', $request->email)->first();

        if (!$usuario || !Hash::check($request->password, $usuario->password)) {
            return back()->withErrors(['email' => 'Las credenciales no son correctas.']);
        }

        // Verificar el rol
        if ($usuario->rol !== $request->rol) {
            return back()->withErrors(['rol' => 'El rol seleccionado no coincide con el usuario.']);
        }

        // Autenticar al usuario
        auth()->login($usuario);

        // Redirigir según el rol
        if ($usuario->rol === 'admin') {
            return redirect()->route('mascotas.index'); // Cambia esta ruta según tu lógica
        }

        return redirect()->route('mascotas.index');
    }

    public function adminDashboard()
    {
        // Aquí puedes cargar datos específicos para el administrador
        return view('mascotas.index'); // Asegúrate de que esta vista exista
    }

    public function createTestUser()
    {
        Usuario::create([
            'nombre' => 'Test User',
            'email' => 'test@test.com',
            'password' => 'password123',
            'rol' => 'user'
        ]);
    }

    public function adminIndex()
    {
        try {
            $usuarios = Usuario::with(['mascotas', 'perdidos'])->get();
            return view('admin.usuarios_list', compact('usuarios'));
        } catch (\Exception $e) {
            Log::error('Error en adminIndex: ' . $e->getMessage());
            return back()->with('error', 'Error al cargar la lista de usuarios');
        }
    }

    public function adminDestroy(User $usuario)
    {
        if($usuario->rol === 'admin') {
            return back()->with('error', 'No se puede eliminar un administrador');
        }

        $usuario->delete();
        return redirect()->route('admin.usuarios')->with('success', 'Usuario eliminado correctamente');
    }
}

