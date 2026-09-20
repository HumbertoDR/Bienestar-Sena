@extends('layouts.app')

@section('title', 'Detalle Solicitud #' . $solicitud->id)
@section('page-title', 'Detalle de Solicitud')

@section('content')

<div class="max-w-3xl mx-auto space-y-4">

    {{-- Header con semáforo --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
        <div class="flex items-start justify-between gap-4">
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <span class="w-4 h-4 rounded-full inline-block flex-shrink-0
                        {{ $solicitud->prioridad === 'alta' ? 'bg-red-500' : ($solicitud->prioridad === 'media' ? 'bg-orange-400' : 'bg-green-500') }}">
                    </span>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ $solicitud->nombre_completo }}
                    </h2>
                    <span class="text-xs px-2 py-0.5 rounded-full font-medium
                        {{ $solicitud->prioridad === 'alta'
                           ? 'bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-400'
                           : ($solicitud->prioridad === 'media'
                              ? 'bg-orange-100 dark:bg-orange-900/40 text-orange-700 dark:text-orange-400'
                              : 'bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-400') }}">
                        Prioridad: {{ ucfirst($solicitud->prioridad) }}
                    </span>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Caso #{{ $solicitud->id }} · Registrado {{ $solicitud->created_at->diffForHumans() }}
                </p>
            </div>

            <div class="flex items-center gap-2 flex-shrink-0">
                <span class="text-xs px-2.5 py-1 rounded-full font-medium
                    {{ $solicitud->estado === 'cerrado'
                       ? 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400'
                       : ($solicitud->estado === 'en_seguimiento'
                          ? 'bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-400'
                          : 'bg-yellow-100 dark:bg-yellow-900/40 text-yellow-700 dark:text-yellow-400') }}">
                    {{ $solicitud->label_estado }}
                </span>
            </div>
        </div>
    </div>

    {{-- Datos del aprendiz --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4 pb-2 border-b border-gray-100 dark:border-gray-700">
            Información del Aprendiz
        </h3>
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
            <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Documento</p>
                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $solicitud->documento ?? 'No registrado' }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Ficha</p>
                <p class="text-sm font-mono font-medium text-gray-900 dark:text-white">{{ $solicitud->ficha_programa }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Edad</p>
                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $solicitud->edad }} años</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Programa</p>
                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $solicitud->nombre_programa ?? 'No especificado' }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Fecha de Atención</p>
                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $solicitud->fecha->format('d/m/Y') }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Categoría</p>
                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $solicitud->label_categoria }}</p>
            </div>
            @if($solicitud->atendidoPor)
            <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Atendido por</p>
                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $solicitud->atendidoPor->name }}</p>
            </div>
            @endif
        </div>
    </div>

    {{-- Nota del caso --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Nota Descriptiva del Caso</h3>
        <p class="text-sm text-gray-700 dark:text-gray-300 whitespace-pre-wrap leading-relaxed">{{ $solicitud->nota }}</p>
    </div>

    {{-- Recomendación IA --}}
    @if($solicitud->recomendacion_ia)
    <div class="bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800 rounded-xl p-5">
        <div class="flex items-center gap-2 mb-3">
            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
            </svg>
            <h3 class="text-sm font-semibold text-purple-800 dark:text-purple-300">Recomendación IA</h3>
        </div>
        <p class="text-sm text-gray-700 dark:text-gray-300 whitespace-pre-wrap leading-relaxed">{{ $solicitud->recomendacion_ia }}</p>
    </div>
    @endif

    {{-- Seguimiento --}}
    @if($solicitud->seguimiento)
    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-5">
        <h3 class="text-sm font-semibold text-blue-800 dark:text-blue-300 mb-3">Notas de Seguimiento</h3>
        <p class="text-sm text-gray-700 dark:text-gray-300 whitespace-pre-wrap leading-relaxed">{{ $solicitud->seguimiento }}</p>
    </div>
    @endif

    {{-- Acciones --}}
    <div class="flex flex-wrap items-center gap-3 pt-2">
        <a href="{{ route('solicitudes.edit', $solicitud) }}"
           class="px-5 py-2 bg-sena-green hover:bg-sena-dark text-white text-sm font-medium rounded-lg transition-colors">
            Editar caso
        </a>
        <a href="{{ route('solicitudes.pdf', $solicitud) }}"
           target="_blank"
           class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
            </svg>
            Descargar Acta PDF
        </a>
        <a href="{{ route('solicitudes.historial') }}?buscar={{ $solicitud->documento ?? $solicitud->ficha_programa }}"
           class="px-5 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600
                  text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg transition-colors">
            Ver historial del aprendiz
        </a>
        <a href="{{ route('solicitudes.index') }}"
           class="px-5 py-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200
                  border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-lg transition-colors ml-auto">
            Volver
        </a>
    </div>
</div>

@endsection
