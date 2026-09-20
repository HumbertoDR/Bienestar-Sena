@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- ═══ FILA 1: KPI Cards ═══ --}}
<div class="grid grid-cols-2 xl:grid-cols-4 gap-4 mb-6">

    {{-- Total --}}
    <div class="relative overflow-hidden rounded-2xl p-5
                bg-gradient-to-br from-sena-500 to-sena-700
                shadow-[0_4px_20px_rgba(57,169,0,.35)] text-white">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold text-white/70 uppercase tracking-wider mb-1">Total</p>
                <p class="text-4xl font-extrabold leading-none">{{ $totalSolicitudes }}</p>
                <p class="text-xs text-white/60 mt-2">Solicitudes registradas</p>
            </div>
            <div class="w-11 h-11 bg-white/15 rounded-xl flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
        </div>
        <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/5 rounded-full"></div>
        <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-white/5 rounded-full"></div>
    </div>

    {{-- Esta semana --}}
    <div class="relative overflow-hidden rounded-2xl p-5
                bg-white dark:bg-[#161e2e]
                border border-gray-100 dark:border-white/5
                shadow-[0_2px_12px_rgba(0,0,0,.06)] dark:shadow-[0_2px_12px_rgba(0,0,0,.3)]">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-1">Esta semana</p>
                <p class="text-4xl font-extrabold text-blue-600 dark:text-blue-400 leading-none">{{ $estaSemana }}</p>
                <p class="text-xs text-gray-400 mt-2">Atenciones recientes</p>
            </div>
            <div class="w-11 h-11 bg-blue-50 dark:bg-blue-900/30 rounded-xl flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- Este mes --}}
    <div class="relative overflow-hidden rounded-2xl p-5
                bg-white dark:bg-[#161e2e]
                border border-gray-100 dark:border-white/5
                shadow-[0_2px_12px_rgba(0,0,0,.06)] dark:shadow-[0_2px_12px_rgba(0,0,0,.3)]">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-1">Este mes</p>
                <p class="text-4xl font-extrabold text-violet-600 dark:text-violet-400 leading-none">{{ $esteMes }}</p>
                <p class="text-xs text-gray-400 mt-2">Atenciones del mes</p>
            </div>
            <div class="w-11 h-11 bg-violet-50 dark:bg-violet-900/30 rounded-xl flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- Alta prioridad --}}
    <div class="relative overflow-hidden rounded-2xl p-5
                bg-white dark:bg-[#161e2e]
                border border-red-100 dark:border-red-900/30
                shadow-[0_2px_12px_rgba(239,68,68,.08)] dark:shadow-[0_2px_12px_rgba(0,0,0,.3)]">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold text-red-400 uppercase tracking-wider mb-1">Alta prioridad</p>
                <p class="text-4xl font-extrabold text-red-600 dark:text-red-400 leading-none">{{ $prioridadAlta }}</p>
                <p class="text-xs text-gray-400 mt-2">Requieren atención urgente</p>
            </div>
            <div class="w-11 h-11 bg-red-50 dark:bg-red-900/30 rounded-xl flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
        </div>
        @if($prioridadAlta > 0)
        <div class="absolute top-3 right-3 w-2 h-2 rounded-full bg-red-500 animate-ping"></div>
        @endif
    </div>

</div>

{{-- ═══ FILA 2: Estado + Semáforo + Acciones rápidas ═══ --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">

    {{-- Estados --}}
    <div class="bg-white dark:bg-[#161e2e] rounded-2xl border border-gray-100 dark:border-white/5
                shadow-[0_2px_12px_rgba(0,0,0,.06)] dark:shadow-[0_2px_12px_rgba(0,0,0,.3)] p-5">
        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-5 flex items-center gap-2">
            <span class="w-1.5 h-4 bg-sena-500 rounded-full inline-block"></span>
            Estado de Solicitudes
        </h3>
        <div class="space-y-4">
            @php
                $estados = [
                    ['label' => 'Pendientes',      'count' => $pendientes,    'color' => 'bg-amber-400',  'text' => 'text-amber-600 dark:text-amber-400'],
                    ['label' => 'En seguimiento',  'count' => $enSeguimiento, 'color' => 'bg-blue-400',   'text' => 'text-blue-600 dark:text-blue-400'],
                    ['label' => 'Cerrados',         'count' => $cerrados,      'color' => 'bg-slate-400',  'text' => 'text-slate-600 dark:text-slate-400'],
                ];
            @endphp
            @foreach($estados as $e)
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full {{ $e['color'] }} flex-shrink-0"></span>
                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ $e['label'] }}</span>
                    </div>
                    <span class="text-sm font-bold {{ $e['text'] }}">{{ $e['count'] }}</span>
                </div>
                <div class="w-full bg-gray-100 dark:bg-white/5 rounded-full h-2 overflow-hidden">
                    <div class="{{ $e['color'] }} h-2 rounded-full transition-all duration-700"
                         style="width: {{ $totalSolicitudes > 0 ? round(($e['count'] / $totalSolicitudes) * 100) : 0 }}%">
                    </div>
                </div>
                <p class="text-right text-xs text-gray-400 mt-0.5">
                    {{ $totalSolicitudes > 0 ? round(($e['count'] / $totalSolicitudes) * 100) : 0 }}%
                </p>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Semáforo IA --}}
    <div class="bg-white dark:bg-[#161e2e] rounded-2xl border border-gray-100 dark:border-white/5
                shadow-[0_2px_12px_rgba(0,0,0,.06)] dark:shadow-[0_2px_12px_rgba(0,0,0,.3)] p-5">
        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-5 flex items-center gap-2">
            <span class="w-1.5 h-4 bg-violet-500 rounded-full inline-block"></span>
            Semáforo de Prioridad IA
        </h3>
        <div class="flex items-center justify-around">
            @php
                $prioridades = [
                    ['label' => 'Alta',  'sub' => 'Crítica',   'count' => $prioridadAlta,  'bg' => 'from-red-500 to-red-600',    'ring' => 'ring-red-200 dark:ring-red-900',    'text' => 'text-red-500'],
                    ['label' => 'Media', 'sub' => 'Moderada',  'count' => $prioridadMedia, 'bg' => 'from-orange-400 to-orange-500','ring' => 'ring-orange-200 dark:ring-orange-900','text' => 'text-orange-500'],
                    ['label' => 'Baja',  'sub' => 'Normal',    'count' => $prioridadBaja,  'bg' => 'from-emerald-400 to-emerald-600','ring' => 'ring-emerald-200 dark:ring-emerald-900','text' => 'text-emerald-500'],
                ];
            @endphp
            @foreach($prioridades as $p)
            <div class="text-center">
                <div class="relative mx-auto w-16 h-16 mb-2">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br {{ $p['bg'] }}
                                ring-4 {{ $p['ring'] }}
                                flex items-center justify-center shadow-lg">
                        <span class="text-white font-extrabold text-xl">{{ $p['count'] }}</span>
                    </div>
                </div>
                <p class="text-xs font-semibold text-gray-700 dark:text-gray-300">{{ $p['label'] }}</p>
                <p class="text-xs {{ $p['text'] }}">{{ $p['sub'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- Mini barra de distribución --}}
        @php $total = $prioridadAlta + $prioridadMedia + $prioridadBaja; @endphp
        @if($total > 0)
        <div class="mt-5 flex rounded-full overflow-hidden h-2.5 gap-0.5">
            <div class="bg-red-500 transition-all" style="width: {{ round(($prioridadAlta/$total)*100) }}%"></div>
            <div class="bg-orange-400 transition-all" style="width: {{ round(($prioridadMedia/$total)*100) }}%"></div>
            <div class="bg-emerald-500 transition-all" style="width: {{ round(($prioridadBaja/$total)*100) }}%"></div>
        </div>
        <div class="flex justify-between text-xs text-gray-400 mt-1">
            <span>{{ round(($prioridadAlta/$total)*100) }}%</span>
            <span>{{ round(($prioridadMedia/$total)*100) }}%</span>
            <span>{{ round(($prioridadBaja/$total)*100) }}%</span>
        </div>
        @endif
    </div>

    {{-- Acciones rápidas --}}
    <div class="bg-white dark:bg-[#161e2e] rounded-2xl border border-gray-100 dark:border-white/5
                shadow-[0_2px_12px_rgba(0,0,0,.06)] dark:shadow-[0_2px_12px_rgba(0,0,0,.3)] p-5">
        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4 flex items-center gap-2">
            <span class="w-1.5 h-4 bg-blue-500 rounded-full inline-block"></span>
            Acciones Rápidas
        </h3>
        <div class="space-y-2.5">
            <a href="{{ route('solicitudes.create') }}"
               class="flex items-center gap-3 p-3 rounded-xl
                      bg-sena-500/5 hover:bg-sena-500/10 dark:hover:bg-sena-500/15
                      border border-sena-500/20
                      text-sena-600 dark:text-sena-400
                      text-sm font-medium transition-all group">
                <div class="w-8 h-8 bg-sena-500/10 rounded-lg flex items-center justify-center
                            group-hover:bg-sena-500/20 transition-colors flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <span>Nueva solicitud</span>
                <svg class="w-3.5 h-3.5 ml-auto opacity-40 group-hover:opacity-70 group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
            <a href="{{ route('solicitudes.historial') }}"
               class="flex items-center gap-3 p-3 rounded-xl
                      bg-blue-500/5 hover:bg-blue-500/10 dark:hover:bg-blue-500/15
                      border border-blue-500/20
                      text-blue-600 dark:text-blue-400
                      text-sm font-medium transition-all group">
                <div class="w-8 h-8 bg-blue-500/10 rounded-lg flex items-center justify-center
                            group-hover:bg-blue-500/20 transition-colors flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <span>Buscar aprendiz</span>
                <svg class="w-3.5 h-3.5 ml-auto opacity-40 group-hover:opacity-70 group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
            <a href="{{ route('solicitudes.excel') }}"
               class="flex items-center gap-3 p-3 rounded-xl
                      bg-emerald-500/5 hover:bg-emerald-500/10 dark:hover:bg-emerald-500/15
                      border border-emerald-500/20
                      text-emerald-600 dark:text-emerald-400
                      text-sm font-medium transition-all group">
                <div class="w-8 h-8 bg-emerald-500/10 rounded-lg flex items-center justify-center
                            group-hover:bg-emerald-500/20 transition-colors flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                </div>
                <span>Exportar Excel</span>
                <svg class="w-3.5 h-3.5 ml-auto opacity-40 group-hover:opacity-70 group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
            <a href="{{ route('solicitudes.index') }}"
               class="flex items-center gap-3 p-3 rounded-xl
                      bg-gray-500/5 hover:bg-gray-500/10 dark:hover:bg-gray-500/15
                      border border-gray-200 dark:border-white/10
                      text-gray-600 dark:text-gray-400
                      text-sm font-medium transition-all group">
                <div class="w-8 h-8 bg-gray-100 dark:bg-white/5 rounded-lg flex items-center justify-center
                            group-hover:bg-gray-200 dark:group-hover:bg-white/10 transition-colors flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                    </svg>
                </div>
                <span>Ver todas las solicitudes</span>
                <svg class="w-3.5 h-3.5 ml-auto opacity-40 group-hover:opacity-70 group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>

</div>

{{-- ═══ FILA 3: Gráficas ═══ --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">

    <div class="bg-white dark:bg-[#161e2e] rounded-2xl border border-gray-100 dark:border-white/5
                shadow-[0_2px_12px_rgba(0,0,0,.06)] dark:shadow-[0_2px_12px_rgba(0,0,0,.3)] p-5">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Solicitudes por semana</h3>
                <p class="text-xs text-gray-400 mt-0.5">Últimas 7 semanas</p>
            </div>
            <span class="text-xs px-2.5 py-1 rounded-full bg-sena-500/10 text-sena-600 dark:text-sena-400 font-medium">
                Tendencia
            </span>
        </div>
        <div style="position: relative; height: 220px;">
            <canvas id="chartSemana"></canvas>
        </div>
    </div>

    <div class="bg-white dark:bg-[#161e2e] rounded-2xl border border-gray-100 dark:border-white/5
                shadow-[0_2px_12px_rgba(0,0,0,.06)] dark:shadow-[0_2px_12px_rgba(0,0,0,.3)] p-5">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Casos por categoría</h3>
                <p class="text-xs text-gray-400 mt-0.5">Distribución total</p>
            </div>
            <span class="text-xs px-2.5 py-1 rounded-full bg-violet-500/10 text-violet-600 dark:text-violet-400 font-medium">
                Categorías
            </span>
        </div>
        <div style="position: relative; height: 220px;">
            <canvas id="chartCategoria"></canvas>
        </div>
    </div>

</div>

{{-- ═══ FILA 4: Programas + Recientes ═══ --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

    <div class="bg-white dark:bg-[#161e2e] rounded-2xl border border-gray-100 dark:border-white/5
                shadow-[0_2px_12px_rgba(0,0,0,.06)] dark:shadow-[0_2px_12px_rgba(0,0,0,.3)] p-5">
        <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-5 flex items-center gap-2">
            <span class="w-1.5 h-4 bg-sena-500 rounded-full inline-block"></span>
            Programas con más solicitudes
        </h3>
        @forelse($porPrograma as $prog)
        <div class="mb-4 last:mb-0">
            <div class="flex justify-between items-center mb-1.5">
                <div class="flex items-center gap-2 min-w-0">
                    <span class="font-mono text-xs bg-sena-500/10 text-sena-600 dark:text-sena-400
                                 px-2 py-0.5 rounded-lg flex-shrink-0">
                        {{ $prog->ficha_programa }}
                    </span>
                    @if($prog->nombre_programa)
                    <span class="text-xs text-gray-500 dark:text-gray-400 truncate">
                        {{ Str::limit($prog->nombre_programa, 28) }}
                    </span>
                    @endif
                </div>
                <span class="text-xs font-bold text-sena-600 dark:text-sena-400 ml-2 flex-shrink-0
                             bg-sena-500/10 px-2 py-0.5 rounded-full">
                    {{ $prog->total }}
                </span>
            </div>
            <div class="w-full bg-gray-100 dark:bg-white/5 rounded-full h-1.5 overflow-hidden">
                <div class="bg-gradient-to-r from-sena-500 to-sena-400 h-1.5 rounded-full transition-all duration-700"
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

    <div class="bg-white dark:bg-[#161e2e] rounded-2xl border border-gray-100 dark:border-white/5
                shadow-[0_2px_12px_rgba(0,0,0,.06)] dark:shadow-[0_2px_12px_rgba(0,0,0,.3)] p-5">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                <span class="w-1.5 h-4 bg-blue-500 rounded-full inline-block"></span>
                Solicitudes recientes
            </h3>
            <a href="{{ route('solicitudes.index') }}"
               class="text-xs font-medium text-sena-600 dark:text-sena-400 hover:underline flex items-center gap-1">
                Ver todas
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
        <div class="space-y-1.5">
            @forelse($recientes as $s)
            <a href="{{ route('solicitudes.show', $s) }}"
               class="flex items-center gap-3 p-2.5 rounded-xl
                      hover:bg-gray-50 dark:hover:bg-white/5
                      transition-colors group">
                {{-- Avatar inicial --}}
                <div class="w-8 h-8 rounded-lg flex items-center justify-center text-white font-bold text-xs flex-shrink-0
                    {{ $s->prioridad === 'alta' ? 'bg-gradient-to-br from-red-400 to-red-600'
                       : ($s->prioridad === 'media' ? 'bg-gradient-to-br from-orange-400 to-orange-600'
                       : 'bg-gradient-to-br from-emerald-400 to-emerald-600') }}">
                    {{ strtoupper(substr($s->nombre, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-800 dark:text-gray-200 truncate group-hover:text-sena-600 dark:group-hover:text-sena-400 transition-colors">
                        {{ $s->nombre_completo }}
                    </p>
                    <p class="text-xs text-gray-400 dark:text-gray-500">
                        Ficha {{ $s->ficha_programa }} · {{ $s->fecha->format('d/m/Y') }}
                    </p>
                </div>
                <span class="text-xs px-2 py-0.5 rounded-full font-medium flex-shrink-0
                    {{ $s->estado === 'cerrado'
                       ? 'bg-gray-100 dark:bg-white/10 text-gray-500 dark:text-gray-400'
                       : ($s->estado === 'en_seguimiento'
                          ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400'
                          : 'bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400') }}">
                    {{ $s->label_estado }}
                </span>
            </a>
            @empty
            <p class="text-sm text-gray-400 text-center py-8">Sin solicitudes recientes.</p>
            @endforelse
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
const isDark    = document.documentElement.classList.contains('dark');
const gridColor = isDark ? 'rgba(255,255,255,0.04)' : 'rgba(0,0,0,0.04)';
const textColor = isDark ? '#64748b' : '#94a3b8';

// ── Gráfico de barras ──
new Chart(document.getElementById('chartSemana'), {
    type: 'bar',
    data: {
        labels: @json($semanaLabels),
        datasets: [{
            label: 'Solicitudes',
            data: @json($solicitudesPorSemana),
            backgroundColor: ctx => {
                const g = ctx.chart.ctx.createLinearGradient(0, 0, 0, 240);
                g.addColorStop(0,   'rgba(57,169,0,.85)');
                g.addColorStop(1,   'rgba(57,169,0,.2)');
                return g;
            },
            borderColor: '#39A900',
            borderWidth: 1.5,
            borderRadius: 8,
            borderSkipped: false,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false }, tooltip: {
            backgroundColor: isDark ? '#1e2533' : '#fff',
            titleColor: isDark ? '#e2e8f0' : '#1e293b',
            bodyColor: isDark ? '#94a3b8' : '#64748b',
            borderColor: isDark ? '#2d3748' : '#e2e8f0',
            borderWidth: 1,
            padding: 10,
            cornerRadius: 10,
        }},
        scales: {
            y: { beginAtZero: true, ticks: { color: textColor, stepSize: 1, precision: 0, font: { size: 11 } }, grid: { color: gridColor } },
            x: { ticks: { color: textColor, font: { size: 11 } }, grid: { display: false } }
        }
    }
});

// ── Gráfico de dona ──
new Chart(document.getElementById('chartCategoria'), {
    type: 'doughnut',
    data: {
        labels: @json($categoriasNames),
        datasets: [{
            data: @json($categoriasData),
            backgroundColor: ['#3b82f6','#ef4444','#f59e0b','#8b5cf6','#64748b'],
            borderWidth: 3,
            borderColor: isDark ? '#161e2e' : '#ffffff',
            hoverOffset: 8,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: { color: textColor, boxWidth: 10, boxHeight: 10, padding: 14, font: { size: 11 }, usePointStyle: true, pointStyle: 'circle' }
            },
            tooltip: {
                backgroundColor: isDark ? '#1e2533' : '#fff',
                titleColor: isDark ? '#e2e8f0' : '#1e293b',
                bodyColor: isDark ? '#94a3b8' : '#64748b',
                borderColor: isDark ? '#2d3748' : '#e2e8f0',
                borderWidth: 1,
                padding: 10,
                cornerRadius: 10,
            }
        },
        cutout: '65%'
    }
});
</script>
@endpush
