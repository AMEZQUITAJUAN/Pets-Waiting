<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use App\Models\Usuario;
use App\Models\Perdido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificacionesController extends Controller
{
    /**
     * Muestra todas las notificaciones del usuario actual
     */
    public function index()
    {
        // Obtener todas las notificaciones del usuario autenticado
        $notificaciones = Notificacion::where('usuario_id', auth()->id())
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(10);

        return view('notificaciones.index', compact('notificaciones'));
    }

    /**
     * Marcar una notificación como leída
     */
    public function marcarComoLeida(Request $request, $id)
    {
        $notificacion = Notificacion::findOrFail($id);

        // Verificar que pertenezca al usuario actual
        if ($notificacion->usuario_id !== auth()->id()) {
            return back()->with('error', 'No tienes permiso para realizar esta acción');
        }

        $notificacion->leido = true;
        $notificacion->save();

        // Verificar si hay una URL específica en el request para redirigir
        if ($request->has('redirect_url')) {
            return redirect($request->redirect_url);
        }

        // Redirigir a la URL de la notificación si existe
        if ($notificacion->url) {
            return redirect($notificacion->url);
        }

        return back()->with('success', 'Notificación marcada como leída');
    }

    /**
     * Marcar todas las notificaciones como leídas
     */
    public function marcarTodasComoLeidas()
    {
        Notificacion::where('usuario_id', auth()->id())
                  ->where('leido', false)
                  ->update(['leido' => true]);

        return back()->with('success', 'Todas las notificaciones marcadas como leídas');
    }

    /**
     * Eliminar una notificación
     */
    public function eliminar($id)
    {
        $notificacion = Notificacion::findOrFail($id);

        // Verificar que pertenezca al usuario actual
        if ($notificacion->usuario_id !== auth()->id()) {
            return back()->with('error', 'No tienes permiso para realizar esta acción');
        }

        $notificacion->delete();

        return back()->with('success', 'Notificación eliminada');
    }

    /**
     * Crear notificación cuando se encuentra una mascota perdida
     */
    public function notificarMascotaEncontrada($perdidoId, $mensaje, $url)
    {
        $perdido = Perdido::find($perdidoId);

        if (!$perdido) {
            return false;
        }

        // Crear notificación para el dueño de la mascota
        Notificacion::create([
            'usuario_id' => $perdido->usuario_id,
            'tipo' => 'encontrado',
            'mensaje' => $mensaje,
            'url' => $url,
            'leido' => false,
            'referencia_id' => $perdido->id,
            'referencia_tipo' => 'App\Models\Perdido'
        ]);

        return true;
    }
}
