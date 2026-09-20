@extends('layouts.app')

@section('title', 'Caso #' . $solicitud->id)
@section('page-title', 'Detalle del Caso')

@section('content')

<div class="max-w-3xl mx-auto space-y-4">

    {{-- ── Barra de navegación superior ── --}}
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <a href="{{ route('solicitudes.index') }}"
               class="w-9 h-9 flex items-center justify-center rounded-xl
                      bg-white dark:bg-[#161e2e] border border-gray-200 dark:border-white/10
                      text-gray-500 hover:text-gray-700 dark:hover:text-gray-300
                      shadow-sm transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <p class="text-xs text-gray-400 dark:text-gray-500">Caso #{{ $solicitud->id }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Registrado {{ $solicitud->created_at->diffForHumans() }}
                </p>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('solicitudes.edit', $solicitud) }}"
               class="h-8 px-3.5 flex items-center gap-1.5 text-xs font-medium
                      bg-white dark:bg-[#161e2e] border border-gray-200 dark:border-white/10
                      text-gray-600 dark:text-gray-400
                      hover:text-sena-600 dark:hover:text-sena-400 hover:border-sena-300 dark:hover:border-sena-700
                      rounded-xl transition-colors shadow-sm">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Editar
            </a>
            <a href="{{ route('solicitudes.pdf', $solicitud) }}" target="_blank"
               class="h-8 px-3.5 flex items-center gap-1.5 text-xs font-medium
                      bg-red-600 hover:bg-red-700 text-white
                      rounded-xl transition-colors shadow-sm">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
                Acta PDF
            </a>
        </div>
    </div>

    {{-- ── Hero Card del caso ── --}}
    <div class="relative overflow-hidden rounded-2xl
                border border-gray-100 dark:border-white/5
                bg-white dark:bg-[#161e2e]
                shadow-[0_2px_12px_rgba(0,0,0,.06)] dark:shadow-[0_2px_12px_rgba(0,0,0,.3)]">

        {{-- Franja de color según prioridad --}}
        <div class="h-1.5 w-full
            {{ $solicitud->prioridad === 'alta'
               ? 'bg-gradient-to-r from-red-500 to-red-400'
               : ($solicitud->prioridad === 'media'
                  ? 'bg-gradient-to-r from-orange-400 to-orange-300'
                  : 'bg-gradient-to-r from-emerald-500 to-emerald-400') }}">
        </div>

        <div class="p-5 flex items-start gap-4">
            {{-- Avatar --}}
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-white font-extrabold text-xl
                        flex-shrink-0 shadow-lg
                {{ $solicitud->prioridad === 'alta'
                   ? 'bg-gradient-to-br from-red-400 to-red-600'
                   : ($solicitud->prioridad === 'media'
                      ? 'bg-gradient-to-br from-orange-400 to-orange-600'
                      : 'bg-gradient-to-br from-sena-400 to-sena-600') }}">
                {{ strtoupper(substr($solicitud->nombre, 0, 1)) }}
            </div>

            <div class="flex-1 min-w-0">
                <div class="flex flex-wrap items-start gap-2 mb-1">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ $solicitud->nombre_completo }}
                    </h2>
                    {{-- Prioridad badge --}}
                    <span class="text-xs px-2.5 py-1 rounded-full font-semibold
                        {{ $solicitud->prioridad === 'alta'
                           ? 'bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800'
                           : ($solicitud->prioridad === 'media'
                              ? 'bg-orange-50 dark:bg-orange-900/20 text-orange-700 dark:text-orange-400 border border-orange-200 dark:border-orange-800'
                              : 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800') }}">
                        {{ ucfirst($solicitud->prioridad) }} prioridad
                    </span>
                    {{-- Estado badge --}}
                    <span class="inline-flex items-center text-xs px-2.5 py-1 rounded-full font-medium
                        {{ $solicitud->estado === 'cerrado'
                           ? 'bg-gray-100 dark:bg-white/8 text-gray-600 dark:text-gray-400'
                           : ($solicitud->estado === 'en_seguimiento'
                              ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400'
                              : 'bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400') }}">
                        <span class="w-1.5 h-1.5 rounded-full mr-1.5
                            {{ $solicitud->estado === 'cerrado' ? 'bg-gray-400'
                               : ($solicitud->estado === 'en_seguimiento' ? 'bg-blue-500' : 'bg-amber-500') }}">
                        </span>
                        {{ $solicitud->label_estado }}
                    </span>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ $solicitud->label_categoria }}
                    @if($solicitud->atendidoPor)
                    · Atendido por <span class="font-medium text-gray-700 dark:text-gray-300">{{ $solicitud->atendidoPor->name }}</span>
                    @endif
                </p>
            </div>
        </div>
    </div>

    {{-- ── Grid de datos del aprendiz ── --}}
    <div class="bg-white dark:bg-[#161e2e] rounded-2xl border border-gray-100 dark:border-white/5
                shadow-[0_2px_12px_rgba(0,0,0,.06)] dark:shadow-[0_2px_12px_rgba(0,0,0,.3)] p-5">
        <h3 class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-4">
            Información del aprendiz
        </h3>
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-y-4 gap-x-6">
            @php
                $datos = [
                    ['Documento',       $solicitud->documento ?? '—'],
                    ['Ficha',           $solicitud->ficha_programa],
                    ['Edad',            $solicitud->edad . ' años'],
                    ['Programa',        $solicitud->nombre_programa ?? 'No especificado'],
                    ['Fecha atención',  $solicitud->fecha->format('d/m/Y')],
                    ['Categoría',       $solicitud->label_categoria],
                ];
            @endphp
            @foreach($datos as [$label, $value])
            <div>
                <p class="text-xs text-gray-400 dark:text-gray-500 mb-0.5">{{ $label }}</p>
                <p class="text-sm font-semibold text-gray-800 dark:text-gray-200
                          {{ $label === 'Ficha' ? 'font-mono' : '' }}">
                    {{ $value }}
                </p>
            </div>
            @endforeach
        </div>
    </div>

    {{-- ── Nota del caso ── --}}
    <div class="bg-white dark:bg-[#161e2e] rounded-2xl border border-gray-100 dark:border-white/5
                shadow-[0_2px_12px_rgba(0,0,0,.06)] dark:shadow-[0_2px_12px_rgba(0,0,0,.3)] p-5">
        <div class="flex items-center gap-2 mb-3">
            <div class="w-6 h-6 rounded-lg bg-gray-100 dark:bg-white/5 flex items-center justify-center">
                <svg class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                </svg>
            </div>
            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Nota descriptiva del caso</h3>
        </div>
        <div class="bg-gray-50 dark:bg-white/3 rounded-xl p-4">
            <p class="text-sm text-gray-700 dark:text-gray-300 whitespace-pre-wrap leading-relaxed">{{ $solicitud->nota }}</p>
        </div>
    </div>

    {{-- ── Recomendación IA ── --}}
    @if($solicitud->recomendacion_ia)
    <div class="rounded-2xl overflow-hidden border
        {{ $solicitud->prioridad === 'alta'
           ? 'border-red-200 dark:border-red-800/50'
           : ($solicitud->prioridad === 'media'
              ? 'border-orange-200 dark:border-orange-800/50'
              : 'border-emerald-200 dark:border-emerald-800/50') }}
        shadow-[0_2px_12px_rgba(0,0,0,.06)] dark:shadow-[0_2px_12px_rgba(0,0,0,.3)]">

        <div class="flex items-center gap-3 px-5 py-3.5
            {{ $solicitud->prioridad === 'alta'
               ? 'bg-red-50 dark:bg-red-900/20'
               : ($solicitud->prioridad === 'media'
                  ? 'bg-orange-50 dark:bg-orange-900/20'
                  : 'bg-emerald-50 dark:bg-emerald-900/20') }}">
            <div class="w-7 h-7 rounded-lg bg-violet-600 flex items-center justify-center flex-shrink-0">
                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-700 dark:text-gray-300">Recomendación IA — Bienestar SENA</p>
                <p class="text-xs
                    {{ $solicitud->prioridad === 'alta' ? 'text-red-600 dark:text-red-400'
                       : ($solicitud->prioridad === 'media' ? 'text-orange-600 dark:text-orange-400'
                       : 'text-emerald-600 dark:text-emerald-400') }}">
                    Prioridad {{ ucfirst($solicitud->prioridad) }}
                </p>
            </div>
        </div>
        <div class="px-5 py-4 bg-white dark:bg-[#161e2e]">
            <p class="text-sm text-gray-700 dark:text-gray-300 whitespace-pre-wrap leading-relaxed">
                {{ $solicitud->recomendacion_ia }}
            </p>
        </div>
    </div>
    @endif

    {{-- ── Seguimiento ── --}}
    @if($solicitud->seguimiento)
    <div class="bg-blue-50 dark:bg-blue-900/10 rounded-2xl overflow-hidden
                border border-blue-200 dark:border-blue-800/50
                shadow-[0_2px_12px_rgba(0,0,0,.06)] dark:shadow-[0_2px_12px_rgba(0,0,0,.3)]">
        <div class="flex items-center gap-3 px-5 py-3.5 border-b border-blue-200 dark:border-blue-800/40">
            <div class="w-6 h-6 rounded-lg bg-blue-600 flex items-center justify-center flex-shrink-0">
                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/>
                </svg>
            </div>
            <h3 class="text-sm font-semibold text-blue-800 dark:text-blue-300">Notas de seguimiento</h3>
        </div>
        <div class="px-5 py-4">
            <p class="text-sm text-gray-700 dark:text-gray-300 whitespace-pre-wrap leading-relaxed">
                {{ $solicitud->seguimiento }}
            </p>
        </div>
    </div>
    @endif

    {{-- ── Acciones finales ── --}}
    <div class="flex flex-wrap items-center gap-3 pt-1">
        <a href="{{ route('solicitudes.edit', $solicitud) }}"
           class="px-5 py-2.5 bg-sena-500 hover:bg-sena-600 text-white text-sm font-semibold
                  rounded-xl transition-all shadow-[0_4px_14px_rgba(57,169,0,.3)]
                  hover:shadow-[0_6px_20px_rgba(57,169,0,.4)] flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Editar caso
        </a>
        <a href="{{ route('solicitudes.historial') }}?buscar={{ $solicitud->documento ?? $solicitud->ficha_programa }}"
           class="px-5 py-2.5 bg-white dark:bg-[#161e2e] border border-gray-200 dark:border-white/10
                  text-gray-600 dark:text-gray-400 text-sm font-medium
                  hover:border-sena-300 dark:hover:border-sena-700 hover:text-sena-600 dark:hover:text-sena-400
                  rounded-xl transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Historial del aprendiz
        </a>
        <a href="{{ route('solicitudes.pdf', $solicitud) }}" target="_blank"
           class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-medium
                  rounded-xl transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
            </svg>
            Descargar Acta PDF
        </a>
    </div>

</div>
@endsection
