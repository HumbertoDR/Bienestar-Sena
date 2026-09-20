<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Forzar que el parámetro de ruta del resource sea {solicitud} en vez de {solicitude}
        Route::singularResourceParameters(false);
        Route::resourceParameters([
            'solicitudes' => 'solicitud',
        ]);
    }
}
