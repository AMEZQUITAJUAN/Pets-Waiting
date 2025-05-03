<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Http\Requests\StoreUsuario; // Asegúrate de importar la clase StoreUsuario
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    public function create()
    {
        return view('formulario'); // Cargar la vista del formulario
    }

    public function store(StoreUsuario $request)
    {
        
        Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Encriptar la contraseña
        ]);

        return redirect()->route('mascotas.index')->with('success', 'Usuario registrado exitosamente.');
    }

    public function index() {
        $usuarios = Usuario::paginate(10); // 10 usuarios por página
        return view('usuarios.index', compact('usuarios'))->with('links', $usuarios->links());
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
            return redirect()->route('admin.dashboard'); // Cambia esta ruta según tu lógica
        }

        return redirect()->route('home');
    }

    public function adminDashboard()
    {
        // Aquí puedes cargar datos específicos para el administrador
        return view('admin'); // Asegúrate de que esta vista exista
    }
}
