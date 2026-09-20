<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SolicitudController;
use Illuminate\Support\Facades\Route;

// Ruta raíz → redirige al login o dashboard
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

// Autenticación
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Rutas protegidas
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Solicitudes CRUD — parámetro {solicitud} en español
    Route::resource('solicitudes', SolicitudController::class)->parameters([
        'solicitudes' => 'solicitud',
    ]);

    // Historial de aprendiz
    Route::get('/historial', [SolicitudController::class, 'historial'])->name('solicitudes.historial');

    // Exportaciones
    Route::get('/exportar/excel', [SolicitudController::class, 'exportarExcel'])->name('solicitudes.excel');
    Route::get('/solicitudes/{solicitud}/pdf', [SolicitudController::class, 'exportarPdf'])->name('solicitudes.pdf');

    // IA: recomendación vía AJAX
    Route::post('/ia/recomendar', [SolicitudController::class, 'recomendar'])->name('ia.recomendar');
});
