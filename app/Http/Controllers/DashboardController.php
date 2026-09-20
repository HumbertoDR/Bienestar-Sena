<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // KPIs generales
        $totalSolicitudes  = Solicitud::count();
        $pendientes        = Solicitud::where('estado', 'pendiente')->count();
        $enSeguimiento     = Solicitud::where('estado', 'en_seguimiento')->count();
        $cerrados          = Solicitud::where('estado', 'cerrado')->count();

        // Prioridades
        $prioridadAlta   = Solicitud::where('prioridad', 'alta')->count();
        $prioridadMedia  = Solicitud::where('prioridad', 'media')->count();
        $prioridadBaja   = Solicitud::where('prioridad', 'baja')->count();

        // Atendidos esta semana
        $estaSemana = Solicitud::whereBetween('fecha', [
            now()->startOfWeek(),
            now()->endOfWeek(),
        ])->count();

        // Atendidos este mes
        $esteMes = Solicitud::whereMonth('fecha', now()->month)
            ->whereYear('fecha', now()->year)
            ->count();

        // Por categoría
        $porCategoria = Solicitud::select('categoria', DB::raw('count(*) as total'))
            ->groupBy('categoria')
            ->pluck('total', 'categoria')
            ->toArray();

        $categoriasLabels = ['academico', 'salud_mental', 'economico', 'personal', 'otro'];
        $categoriasData   = array_map(fn($c) => $porCategoria[$c] ?? 0, $categoriasLabels);
        $categoriasNames  = ['Académico', 'Salud Mental', 'Económico', 'Personal', 'Otro'];

        // Programas con más solicitudes (top 8)
        $porPrograma = Solicitud::select('ficha_programa', 'nombre_programa', DB::raw('count(*) as total'))
            ->groupBy('ficha_programa', 'nombre_programa')
            ->orderByDesc('total')
            ->limit(8)
            ->get();

        // Últimas 7 semanas de solicitudes
        $solicitudesPorSemana = [];
        $semanaLabels         = [];
        for ($i = 6; $i >= 0; $i--) {
            $inicio = now()->subWeeks($i)->startOfWeek();
            $fin    = now()->subWeeks($i)->endOfWeek();
            $count  = Solicitud::whereBetween('fecha', [$inicio, $fin])->count();
            $solicitudesPorSemana[] = $count;
            $semanaLabels[]         = 'Sem ' . $inicio->format('d/m');
        }

        // Últimas 6 solicitudes recientes
        $recientes = Solicitud::latest()->limit(6)->get();

        return view('dashboard', compact(
            'totalSolicitudes', 'pendientes', 'enSeguimiento', 'cerrados',
            'prioridadAlta', 'prioridadMedia', 'prioridadBaja',
            'estaSemana', 'esteMes',
            'categoriasLabels', 'categoriasData', 'categoriasNames',
            'porPrograma',
            'solicitudesPorSemana', 'semanaLabels',
            'recientes'
        ));
    }
}
