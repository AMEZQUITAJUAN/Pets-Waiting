<?php
namespace App\Http\Controllers;

use App\Models\Notificacion;
use App\Models\Usuario;
use App\Models\Perdido;
use App\Models\Adopcion;
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

        // Agregar esta línea para definir ultimasNotificaciones
        $ultimasNotificaciones = Notificacion::where('usuario_id', auth()->id())
                                   ->orderBy('created_at', 'desc')
                                   ->take(5)
                                   ->get();

        return view('notificaciones.index', compact('notificaciones', 'ultimasNotificaciones'));
    }

    /**
     * Muestra los detalles de una notificación específica
     */
    public function show($id)
    {
        try {
            $notificacion = Notificacion::findOrFail($id);

            // Verificar que pertenezca al usuario actual
            if ($notificacion->usuario_id !== auth()->id()) {
                return back()->with('error', 'No tienes permiso para ver esta notificación');
            }

            // Agregar esta línea para definir ultimasNotificaciones
            $ultimasNotificaciones = Notificacion::where('usuario_id', auth()->id())
                                   ->orderBy('created_at', 'desc')
                                   ->take(5)
                                   ->get();

            // Marcar como leída si no lo está
            if (!$notificacion->leido) {
                $notificacion->leido = true;
                $notificacion->save();
            }

            // Cargar datos relacionados según el tipo de notificación
            if ($notificacion->tipo == 'adopcion' && $notificacion->referencia_id) {
                $adopcion = Adopcion::with('mascota')->find($notificacion->referencia_id);
                return view('notificaciones.show', compact('notificacion', 'adopcion', 'ultimasNotificaciones'));
            }

            if ($notificacion->tipo == 'encontrado' && $notificacion->referencia_id) {
                $perdido = Perdido::find($notificacion->referencia_id);
                return view('notificaciones.show', compact('notificacion', 'perdido', 'ultimasNotificaciones'));
            }

            // Para otros tipos de notificación o sin referencia
            return view('notificaciones.show', compact('notificacion', 'ultimasNotificaciones'));

        } catch (\Exception $e) {
            \Log::error('Error al mostrar notificación: ' . $e->getMessage());
            return redirect()->route('notificaciones.index')
                ->with('error', 'La notificación solicitada no existe o no está disponible');
        }
    }

    /**
     * Marcar una notificación como leída
     */
    public function marcarComoLeida(Request $request, $id)
    {
        try {
            $notificacion = Notificacion::findOrFail($id);

            // Verificar que pertenezca al usuario actual
            if ($notificacion->usuario_id !== auth()->id()) {
                return redirect()->route('home')->with('error', 'No tienes permiso para realizar esta acción');
            }

            $notificacion->leido = true;
            $notificacion->save();

            // Verificar si hay una URL específica en el request para redirigir
            if ($request->has('redirect_url')) {
                try {
                    return redirect($request->redirect_url);
                } catch (\Exception $e) {
                    \Log::error('Error al redireccionar: ' . $e->getMessage());
                    return redirect()->route('home')->with('warning', 'No se pudo encontrar la página solicitada');
                }
            }

            // Redirección segura
            return redirect()->route('home')->with('success', 'Notificación marcada como leída');
        } catch (\Exception $e) {
            \Log::error('Error al marcar notificación: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Ocurrió un error al procesar la solicitud');
        }
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
