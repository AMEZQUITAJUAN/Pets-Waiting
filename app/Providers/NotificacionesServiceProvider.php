<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Notificacion;

class NotificacionesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            // Solo ejecuta esta lógica si hay un usuario autenticado
            if (auth()->check()) {
                $ultimasNotificaciones = Notificacion::where('usuario_id', auth()->id())
                                      ->orderBy('created_at', 'desc')
                                      ->take(5)
                                      ->get();
                
                $notificacionesNoLeidas = Notificacion::where('usuario_id', auth()->id())
                                      ->where('leido', false)
                                      ->count();
                
                $view->with([
                    'ultimasNotificaciones' => $ultimasNotificaciones,
                    'notificacionesNoLeidas' => $notificacionesNoLeidas
                ]);
            }
        });
    }
}