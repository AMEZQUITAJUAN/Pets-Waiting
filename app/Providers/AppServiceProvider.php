<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        Route::resourceVerbs(
            [
                'create' => 'crear',
                'edit' => 'editar',
                'show' => 'ver',
                'index' => 'listar',
                'store' => 'guardar',
                'update' => 'actualizar',
                'destroy' => 'eliminar'
            ]
        );
    }
}
