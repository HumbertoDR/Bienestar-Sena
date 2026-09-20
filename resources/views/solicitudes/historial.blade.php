@extends('layouts.app')

@section('title', 'Historial de Aprendiz')
@section('page-title', 'Historial por Aprendiz')

@section('content')

<div class="max-w-3xl mx-auto space-y-5">

    {{-- ── Buscador ── --}}
    <div class="bg-white dark:bg-[#161e2e] rounded-2xl border border-gray-100 dark:border-white/5
                shadow-[0_2px_12px_rgba(0,0,0,.06)] dark:shadow-[0_2px_12px_rgba(0,0,0,.3)] p-5">
        <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-1.5">
            Consultar historial de aprendiz
        </h2>
        <p class="text-xs text-gray-400 dark:text-gray-500 mb-4">
            Ingresa el número de cédula, tarjeta de identidad o ficha del programa.
        </p>
        <form method="GET" action="{{ route('solicitudes.historial') }}" class="flex gap-3">
            <div class="flex-1 relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" name="buscar" value="{{ $buscar }}"
                       placeholder="Documento o ficha de programa…"
                       autofocus
                       class="input-field pl-10"/>
            </div>
            <button type="submit"
                    class="px-5 py-2 bg-sena-500 hover:bg-sena-600 text-white text-sm font-semibold
                           rounded-xl transition-all shadow-[0_4px_14px_rgba(57,169,0,.3)]
                           flex items-center gap-2 flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Buscar
            </button>
        </form>
    </div>

    {{-- ── Resultados ── --}}
    @if($buscar)
        @if($solicitudes->isEmpty())
            {{-- Sin resultados --}}
            <div class="bg-white dark:bg-[#161e2e] rounded-2xl border border-gray-100 dark:border-white/5
                        shadow-[0_2px_12px_rgba(0,0,0,.06)] dark:shadow-[0_2px_12px_rgba(0,0,0,.3)] p-10 text-center">
                <div class="w-16 h-16 bg-gray-50 dark:bg-white/5 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">Sin registros encontrados</p>
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1.5">
                    El aprendiz con documento o ficha
                    <span class="font-mono font-semibold text-gray-600 dark:text-gray-300 bg-gray-100 dark:bg-white/10 px-1.5 py-0.5 rounded">
                        {{ $buscar }}
                    </span>
                    no tiene visitas registradas.
                </p>
                <a href="{{ route('solicitudes.create') }}"
                   class="inline-flex items-center gap-1.5 mt-4 text-sm font-medium text-sena-600 dark:text-sena-400 hover:underline">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Registrar nueva solicitud
                </a>
            </div>

        @else
            @php $aprendiz = $solicitudes->first() @endphp

            {{-- ── Tarjeta del aprendiz ── --}}
            <div class="relative overflow-hidden rounded-2xl p-5
                        bg-gradient-to-br from-sena-500 to-sena-700 text-white
                        shadow-[0_4px_20px_rgba(57,169,0,.3)]">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center
                                font-extrabold text-xl flex-shrink-0 shadow-inner">
                        {{ strtoupper(substr($aprendiz->nombre, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-lg font-bold">{{ $aprendiz->nombre_completo }}</p>
                        <div class="flex flex-wrap items-center gap-3 mt-1 text-sm text-white/70">
                            @if($aprendiz->documento)
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2"/>
                                </svg>
                                Doc: {{ $aprendiz->documento }}
                            </span>
                            @endif
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/>
                                </svg>
                                Ficha: {{ $aprendiz->ficha_programa }}
                            </span>
                        </div>
                    </div>
                    <div class="text-right flex-shrink-0">
                        <p class="text-3xl font-extrabold">{{ $solicitudes->count() }}</p>
                        <p class="text-xs text-white/60">{{ $solicitudes->count() === 1 ? 'visita' : 'visitas' }}</p>
                    </div>
                </div>
                {{-- Decoración --}}
                <div class="absolute -right-6 -bottom-6 w-28 h-28 bg-white/5 rounded-full pointer-events-none"></div>
            </div>

            {{-- ── Timeline de visitas ── --}}
            <div class="relative">
                {{-- Línea vertical del timeline --}}
                <div class="absolute left-5 top-0 bottom-0 w-0.5 bg-gray-100 dark:bg-white/5"></div>

                <div class="space-y-3 pl-14">
                    @foreach($solicitudes as $index => $s)
                    <div class="relative">
                        {{-- Punto del timeline --}}
                        <div class="absolute -left-[2.15rem] top-4 w-5 h-5 rounded-full
                                    flex items-center justify-center
                                    border-2 border-white dark:border-[#0f1623]
                                    shadow-md z-10
                            {{ $s->prioridad === 'alta'
                               ? 'bg-red-500'
                               : ($s->prioridad === 'media'
                                  ? 'bg-orange-400'
                                  : 'bg-emerald-500') }}">
                            <span class="text-white text-xs font-bold">{{ $index + 1 }}</span>
                        </div>

                        {{-- Card de visita --}}
                        <div class="bg-white dark:bg-[#161e2e] rounded-2xl border border-gray-100 dark:border-white/5
                                    shadow-[0_2px_12px_rgba(0,0,0,.06)] dark:shadow-[0_2px_12px_rgba(0,0,0,.3)]
                                    p-4 hover:border-sena-200 dark:hover:border-sena-800/50 transition-colors">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-wrap items-center gap-2 mb-2">
                                        <span class="text-sm font-bold text-gray-900 dark:text-white">
                                            {{ $s->fecha->format('d/m/Y') }}
                                        </span>
                                        <span class="text-xs text-gray-400 dark:text-gray-500">
                                            {{ $s->fecha->diffForHumans() }}
                                        </span>
                                        {{-- Estado --}}
                                        <span class="inline-flex items-center text-xs px-2 py-0.5 rounded-full font-medium
                                            {{ $s->estado === 'cerrado'
                                               ? 'bg-gray-100 dark:bg-white/8 text-gray-600 dark:text-gray-400'
                                               : ($s->estado === 'en_seguimiento'
                                                  ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400'
                                                  : 'bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400') }}">
                                            <span class="w-1.5 h-1.5 rounded-full mr-1
                                                {{ $s->estado === 'cerrado' ? 'bg-gray-400'
                                                   : ($s->estado === 'en_seguimiento' ? 'bg-blue-500' : 'bg-amber-500') }}">
                                            </span>
                                            {{ $s->label_estado }}
                                        </span>
                                        {{-- Categoría --}}
                                        <span class="text-xs px-2 py-0.5 rounded-full
                                                     bg-gray-50 dark:bg-white/5 text-gray-500 dark:text-gray-400
                                                     border border-gray-200 dark:border-white/10">
                                            {{ $s->label_categoria }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2 leading-relaxed">
                                        {{ $s->nota }}
                                    </p>
                                    @if($s->recomendacion_ia)
                                    <p class="flex items-center gap-1.5 text-xs text-violet-600 dark:text-violet-400 mt-2">
                                        <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        Análisis IA registrado
                                    </p>
                                    @endif
                                </div>
                                <a href="{{ route('solicitudes.show', $s) }}"
                                   class="flex-shrink-0 flex items-center gap-1.5 text-xs font-semibold
                                          text-sena-600 dark:text-sena-400
                                          hover:text-sena-700 dark:hover:text-sena-300
                                          bg-sena-500/8 dark:bg-sena-500/10 hover:bg-sena-500/15
                                          px-3 py-1.5 rounded-lg transition-colors">
                                    Ver
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endif

</div>
@endsection
