@extends('layouts.app')

@section('title', 'Historial de Aprendiz')
@section('page-title', 'Historial por Aprendiz')

@section('content')

<div class="max-w-3xl mx-auto space-y-5">

    {{-- Buscador --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
        <h2 class="text-base font-semibold text-gray-800 dark:text-gray-200 mb-3">
            Buscar aprendiz
        </h2>
        <form method="GET" action="{{ route('solicitudes.historial') }}" class="flex gap-3">
            <input type="text" name="buscar" value="{{ $buscar }}"
                   placeholder="Ingresa número de documento o ficha de programa…"
                   autofocus
                   class="flex-1 px-4 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600
                          bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                          focus:outline-none focus:ring-2 focus:ring-sena-green focus:border-transparent"/>
            <button type="submit"
                    class="px-5 py-2 bg-sena-green hover:bg-sena-dark text-white text-sm font-medium
                           rounded-lg transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Buscar
            </button>
        </form>
        <p class="text-xs text-gray-400 dark:text-gray-500 mt-2">
            Busca por número de cédula, tarjeta de identidad o número de ficha del programa.
        </p>
    </div>

    {{-- Resultados --}}
    @if($buscar)
        @if($solicitudes->isEmpty())
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-8 text-center">
                <svg class="w-12 h-12 mx-auto mb-3 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-gray-500 dark:text-gray-400 font-medium">No se encontraron registros</p>
                <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">
                    El aprendiz con documento o ficha <strong>{{ $buscar }}</strong> no tiene visitas previas.
                </p>
            </div>
        @else
            {{-- Resumen --}}
            @php $aprendiz = $solicitudes->first() @endphp
            <div class="bg-sena-green/10 dark:bg-sena-green/5 border border-sena-green/30 rounded-xl p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-sena-green rounded-full flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr($aprendiz->nombre, 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 dark:text-white">{{ $aprendiz->nombre_completo }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ $solicitudes->count() }} {{ $solicitudes->count() === 1 ? 'visita registrada' : 'visitas registradas' }}
                            @if($aprendiz->documento) · Doc: {{ $aprendiz->documento }}@endif
                        </p>
                    </div>
                </div>
            </div>

            {{-- Timeline de visitas --}}
            <div class="space-y-3">
                @foreach($solicitudes as $s)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-4
                             hover:border-sena-green/40 transition-colors">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex items-start gap-3 flex-1">
                            <span class="w-3 h-3 rounded-full flex-shrink-0 mt-1.5
                                {{ $s->prioridad === 'alta' ? 'bg-red-500' : ($s->prioridad === 'media' ? 'bg-orange-400' : 'bg-green-500') }}">
                            </span>
                            <div class="flex-1">
                                <div class="flex flex-wrap items-center gap-2 mb-1">
                                    <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                        {{ $s->fecha->format('d/m/Y') }}
                                    </span>
                                    <span class="text-xs px-2 py-0.5 rounded-full
                                        {{ $s->estado === 'cerrado'
                                           ? 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400'
                                           : ($s->estado === 'en_seguimiento'
                                              ? 'bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-400'
                                              : 'bg-yellow-100 dark:bg-yellow-900/40 text-yellow-700 dark:text-yellow-400') }}">
                                        {{ $s->label_estado }}
                                    </span>
                                    <span class="text-xs px-2 py-0.5 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400">
                                        {{ $s->label_categoria }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">{{ $s->nota }}</p>
                                @if($s->recomendacion_ia)
                                    <p class="text-xs text-purple-600 dark:text-purple-400 mt-1 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        Tiene recomendación IA
                                    </p>
                                @endif
                            </div>
                        </div>
                        <a href="{{ route('solicitudes.show', $s) }}"
                           class="flex-shrink-0 text-xs text-sena-green hover:text-sena-dark font-medium hover:underline">
                            Ver detalle →
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    @endif
</div>

@endsection
