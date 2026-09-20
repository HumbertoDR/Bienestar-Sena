@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard — Estadísticas')

@section('content')

{{-- KPIs --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total</p>
                <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $totalSolicitudes }}</p>
            </div>
            <div class="w-12 h-12 bg-green-50 dark:bg-green-900/30 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-[#39A900]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
        </div>
        <p class="text-xs text-gray-400 mt-2">Solicitudes registradas</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Esta semana</p>
                <p class="text-3xl font-bold text-blue-600 dark:text-blue-400 mt-1">{{ $estaSemana }}</p>
            </div>
            <div class="w-12 h-12 bg-blue-50 dark:bg-blue-900/30 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>
        <p class="text-xs text-gray-400 mt-2">Atendidos esta semana</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Este mes</p>
                <p class="text-3xl font-bold text-purple-600 dark:text-purple-400 mt-1">{{ $esteMes }}</p>
            </div>
            <div class="w-12 h-12 bg-purple-50 dark:bg-purple-900/30 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
        </div>
        <p class="text-xs text-gray-400 mt-2">Atendidos este mes</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Alta prioridad</p>
                <p class="text-3xl font-bold text-red-600 dark:text-red-400 mt-1">{{ $prioridadAlta }}</p>
            </div>
            <div class="w-12 h-12 bg-red-50 dark:bg-red-900/30 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
        </div>
        <p class="text-xs text-gray-400 mt-2">Requieren atención urgente</p>
    </div>

</div>

{{-- Fila 2: Estados + Semáforo + Acciones rápidas --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">Estado de Solicitudes</h3>
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-yellow-400"></span>
                    <span class="text-sm text-gray-600 dark:text-gray-400">Pendientes</span>
                </div>
                <span class="text-lg font-bold text-yellow-600">{{ $pendientes }}</span>
            </div>
            <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-1.5">
                <div class="bg-yellow-400 h-1.5 rounded-full" style="width: {{ $totalSolicitudes > 0 ? round(($pendientes/$totalSolicitudes)*100) : 0 }}%"></div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-blue-400"></span>
                    <span class="text-sm text-gray-600 dark:text-gray-400">En seguimiento</span>
                </div>
                <span class="text-lg font-bold text-blue-600">{{ $enSeguimiento }}</span>
            </div>
            <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-1.5">
                <div class="bg-blue-400 h-1.5 rounded-full" style="width: {{ $totalSolicitudes > 0 ? round(($enSeguimiento/$totalSolicitudes)*100) : 0 }}%"></div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-gray-400"></span>
                    <span class="text-sm text-gray-600 dark:text-gray-400">Cerrados</span>
                </div>
                <span class="text-lg font-bold text-gray-600">{{ $cerrados }}</span>
            </div>
            <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-1.5">
                <div class="bg-gray-400 h-1.5 rounded-full" style="width: {{ $totalSolicitudes > 0 ? round(($cerrados/$totalSolicitudes)*100) : 0 }}%"></div>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-5">Semáforo de Prioridad IA</h3>
        <div class="flex items-center justify-around mt-2">
            <div class="text-center">
                <div class="w-16 h-16 rounded-full bg-red-500 flex items-center justify-center mx-auto shadow-lg">
                    <span class="text-white font-bold text-xl">{{ $prioridadAlta }}</span>
                </div>
                <p class="text-xs font-medium text-gray-600 dark:text-gray-400 mt-2">Alta</p>
                <p class="text-xs text-red-500">Crítica</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 rounded-full bg-orange-400 flex items-center justify-center mx-auto shadow-lg">
                    <span class="text-white font-bold text-xl">{{ $prioridadMedia }}</span>
                </div>
                <p class="text-xs font-medium text-gray-600 dark:text-gray-400 mt-2">Media</p>
                <p class="text-xs text-orange-500">Moderada</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 rounded-full bg-green-500 flex items-center justify-center mx-auto shadow-lg">
                    <span class="text-white font-bold text-xl">{{ $prioridadBaja }}</span>
                </div>
                <p class="text-xs font-medium text-gray-600 dark:text-gray-400 mt-2">Baja</p>
                <p class="text-xs text-green-500">Normal</p>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">Acciones Rápidas</h3>
        <div class="space-y-3">
            <a href="{{ route('solicitudes.create') }}"
               class="flex items-center gap-3 p-3 bg-green-50 dark:bg-green-900/20 hover:bg-green-100 dark:hover:bg-green-900/30
                      rounded-lg text-[#39A900] dark:text-green-400 text-sm font-medium transition-colors">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nueva solicitud
            </a>
            <a href="{{ route('solicitudes.historial') }}"
               class="flex items-center gap-3 p-3 bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/30
                      rounded-lg text-blue-700 dark:text-blue-400 text-sm font-medium transition-colors">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Buscar aprendiz
            </a>
            <a href="{{ route('solicitudes.excel') }}"
               class="flex items-center gap-3 p-3 bg-emerald-50 dark:bg-emerald-900/20 hover:bg-emerald-100 dark:hover:bg-emerald-900/30
                      rounded-lg text-emerald-700 dark:text-emerald-400 text-sm font-medium transition-colors">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Exportar Excel
            </a>
            <a href="{{ route('solicitudes.index') }}"
               class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700/50 hover:bg-gray-100 dark:hover:bg-gray-700
                      rounded-lg text-gray-700 dark:text-gray-300 text-sm font-medium transition-colors">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                </svg>
                Ver todas las solicitudes
            </a>
        </div>
    </div>

</div>

{{-- Fila 3: Gráficos --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">
            Solicitudes — Últimas 7 Semanas
        </h3>
        <div style="position: relative; height: 240px;">
            <canvas id="chartSemana"></canvas>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">
            Casos por Categoría
        </h3>
        <div style="position: relative; height: 240px;">
            <canvas id="chartCategoria"></canvas>
        </div>
    </div>

</div>

{{-- Fila 4: Programas + Recientes --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">
            Programas con más Solicitudes
        </h3>
        @forelse($porPrograma as $prog)
            <div class="mb-4">
                <div class="flex justify-between items-center mb-1">
                    <span class="text-xs text-gray-600 dark:text-gray-400 truncate max-w-xs">
                        <span class="font-mono bg-gray-100 dark:bg-gray-700 px-1.5 py-0.5 rounded text-xs">{{ $prog->ficha_programa }}</span>
                        @if($prog->nombre_programa)
                            <span class="ml-1">{{ Str::limit($prog->nombre_programa, 30) }}</span>
                        @endif
                    </span>
                    <span class="text-xs font-bold text-[#39A900] ml-2 flex-shrink-0">{{ $prog->total }}</span>
                </div>
                <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-2">
                    <div class="bg-[#39A900] rounded-full h-2 transition-all duration-500"
                         style="width: {{ $porPrograma->max('total') > 0 ? round(($prog->total / $porPrograma->max('total')) * 100) : 0 }}%">
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-8">
                <p class="text-sm text-gray-400">Sin datos registrados.</p>
            </div>
        @endforelse
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Solicitudes Recientes</h3>
            <a href="{{ route('solicitudes.index') }}" class="text-xs text-[#39A900] hover:underline">Ver todas</a>
        </div>
        <div class="space-y-2">
            @forelse($recientes as $s)
                <a href="{{ route('solicitudes.show', $s) }}"
                   class="flex items-center gap-3 p-2.5 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <span class="w-3 h-3 rounded-full flex-shrink-0
                        {{ $s->prioridad === 'alta' ? 'bg-red-500' : ($s->prioridad === 'media' ? 'bg-orange-400' : 'bg-green-500') }}">
                    </span>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200 truncate">
                            {{ $s->nombre_completo }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            Ficha {{ $s->ficha_programa }} · {{ $s->fecha->format('d/m/Y') }}
                        </p>
                    </div>
                    <span class="text-xs px-2 py-0.5 rounded-full flex-shrink-0
                        {{ $s->estado === 'cerrado'
                           ? 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400'
                           : ($s->estado === 'en_seguimiento'
                              ? 'bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-400'
                              : 'bg-yellow-100 dark:bg-yellow-900/40 text-yellow-700 dark:text-yellow-400') }}">
                        {{ $s->label_estado }}
                    </span>
                </a>
            @empty
                <p class="text-sm text-gray-400 text-center py-6">Sin solicitudes recientes.</p>
            @endforelse
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
const isDark    = document.documentElement.classList.contains('dark');
const gridColor = isDark ? 'rgba(255,255,255,0.07)' : 'rgba(0,0,0,0.05)';
const textColor = isDark ? '#9ca3af' : '#6b7280';

// Gráfico de barras — Solicitudes por semana
new Chart(document.getElementById('chartSemana'), {
    type: 'bar',
    data: {
        labels: @json($semanaLabels),
        datasets: [{
            label: 'Solicitudes',
            data: @json($solicitudesPorSemana),
            backgroundColor: 'rgba(57,169,0,0.75)',
            borderColor: '#39A900',
            borderWidth: 1,
            borderRadius: 6,
            borderSkipped: false,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { color: textColor, stepSize: 1, precision: 0 },
                grid: { color: gridColor }
            },
            x: {
                ticks: { color: textColor },
                grid: { display: false }
            }
        }
    }
});

// Gráfico de dona — Casos por categoría
new Chart(document.getElementById('chartCategoria'), {
    type: 'doughnut',
    data: {
        labels: @json($categoriasNames),
        datasets: [{
            data: @json($categoriasData),
            backgroundColor: ['#3b82f6','#ef4444','#f59e0b','#8b5cf6','#6b7280'],
            borderWidth: 3,
            borderColor: isDark ? '#1f2937' : '#ffffff',
            hoverOffset: 6,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    color: textColor,
                    boxWidth: 12,
                    padding: 16,
                    font: { size: 12 }
                }
            }
        },
        cutout: '60%'
    }
});
</script>
@endpush
