@extends('layouts.app')

@section('title', 'Editar Solicitud #' . $solicitud->id)
@section('page-title', 'Editar Solicitud')

@section('content')

<div class="max-w-3xl mx-auto" x-data="solicitudForm()">

    {{-- Header --}}
    <div class="flex items-center gap-4 mb-5">
        <a href="{{ route('solicitudes.show', $solicitud) }}"
           class="w-9 h-9 flex items-center justify-center rounded-xl
                  bg-white dark:bg-[#161e2e] border border-gray-200 dark:border-white/10
                  text-gray-500 hover:text-gray-700 dark:hover:text-gray-300
                  shadow-sm transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <div>
            <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                Editar Caso #{{ $solicitud->id }}
            </h2>
            <p class="text-xs text-gray-400 dark:text-gray-500">{{ $solicitud->nombre_completo }}</p>
        </div>
        {{-- Badge prioridad actual --}}
        <span class="ml-auto text-xs px-3 py-1.5 rounded-full font-semibold
            {{ $solicitud->prioridad === 'alta'
               ? 'bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800'
               : ($solicitud->prioridad === 'media'
                  ? 'bg-orange-50 dark:bg-orange-900/20 text-orange-700 dark:text-orange-400 border border-orange-200 dark:border-orange-800'
                  : 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800') }}">
            Prioridad {{ ucfirst($solicitud->prioridad) }}
        </span>
    </div>

    <form method="POST" action="{{ route('solicitudes.update', $solicitud) }}" class="space-y-4">
        @csrf
        @method('PUT')

        {{-- ── Datos del aprendiz ── --}}
        <div class="bg-white dark:bg-[#161e2e] rounded-2xl border border-gray-100 dark:border-white/5
                    shadow-[0_2px_12px_rgba(0,0,0,.06)] dark:shadow-[0_2px_12px_rgba(0,0,0,.3)] overflow-hidden">
            <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100 dark:border-white/5">
                <div class="w-7 h-7 rounded-lg bg-sena-500/10 flex items-center justify-center flex-shrink-0">
                    <svg class="w-3.5 h-3.5 text-sena-600 dark:text-sena-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Datos del aprendiz</h3>
            </div>
            <div class="p-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Nombre <span class="text-red-500">*</span></label>
                    <input type="text" name="nombre" value="{{ old('nombre', $solicitud->nombre) }}" required class="input-field @error('nombre') !border-red-500 @enderror"/>
                    @error('nombre')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Apellido <span class="text-red-500">*</span></label>
                    <input type="text" name="apellido" value="{{ old('apellido', $solicitud->apellido) }}" required class="input-field @error('apellido') !border-red-500 @enderror"/>
                    @error('apellido')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wide">N° Documento</label>
                    <input type="text" name="documento" value="{{ old('documento', $solicitud->documento) }}" class="input-field"/>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Edad <span class="text-red-500">*</span></label>
                    <input type="number" name="edad" value="{{ old('edad', $solicitud->edad) }}" required min="14" max="100" class="input-field"/>
                </div>
            </div>
        </div>

        {{-- ── Programa ── --}}
        <div class="bg-white dark:bg-[#161e2e] rounded-2xl border border-gray-100 dark:border-white/5
                    shadow-[0_2px_12px_rgba(0,0,0,.06)] dark:shadow-[0_2px_12px_rgba(0,0,0,.3)] overflow-hidden">
            <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100 dark:border-white/5">
                <div class="w-7 h-7 rounded-lg bg-blue-500/10 flex items-center justify-center flex-shrink-0">
                    <svg class="w-3.5 h-3.5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Programa de formación</h3>
            </div>
            <div class="p-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Ficha <span class="text-red-500">*</span></label>
                    <input type="text" name="ficha_programa" value="{{ old('ficha_programa', $solicitud->ficha_programa) }}" required class="input-field font-mono"/>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Nombre del Programa</label>
                    <input type="text" name="nombre_programa" value="{{ old('nombre_programa', $solicitud->nombre_programa) }}" class="input-field"/>
                </div>
            </div>
        </div>

        {{-- ── Atención ── --}}
        <div class="bg-white dark:bg-[#161e2e] rounded-2xl border border-gray-100 dark:border-white/5
                    shadow-[0_2px_12px_rgba(0,0,0,.06)] dark:shadow-[0_2px_12px_rgba(0,0,0,.3)] overflow-hidden">
            <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100 dark:border-white/5">
                <div class="w-7 h-7 rounded-lg bg-violet-500/10 flex items-center justify-center flex-shrink-0">
                    <svg class="w-3.5 h-3.5 text-violet-600 dark:text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Datos de la atención</h3>
            </div>
            <div class="p-5 space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Fecha <span class="text-red-500">*</span></label>
                        <input type="date" name="fecha" value="{{ old('fecha', $solicitud->fecha->format('Y-m-d')) }}" required class="input-field"/>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Categoría <span class="text-red-500">*</span></label>
                        <select name="categoria" required class="input-field">
                            <option value="academico"    {{ old('categoria', $solicitud->categoria) === 'academico'    ? 'selected' : '' }}>Académico</option>
                            <option value="salud_mental" {{ old('categoria', $solicitud->categoria) === 'salud_mental' ? 'selected' : '' }}>Salud Mental</option>
                            <option value="economico"    {{ old('categoria', $solicitud->categoria) === 'economico'    ? 'selected' : '' }}>Económico</option>
                            <option value="personal"     {{ old('categoria', $solicitud->categoria) === 'personal'     ? 'selected' : '' }}>Personal</option>
                            <option value="otro"         {{ old('categoria', $solicitud->categoria) === 'otro'         ? 'selected' : '' }}>Otro</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Estado <span class="text-red-500">*</span></label>
                        <select name="estado" required class="input-field">
                            <option value="pendiente"      {{ old('estado', $solicitud->estado) === 'pendiente'      ? 'selected' : '' }}>Pendiente</option>
                            <option value="en_seguimiento" {{ old('estado', $solicitud->estado) === 'en_seguimiento' ? 'selected' : '' }}>En seguimiento</option>
                            <option value="cerrado"        {{ old('estado', $solicitud->estado) === 'cerrado'        ? 'selected' : '' }}>Cerrado</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wide">
                        Nota descriptiva <span class="text-red-500">*</span>
                    </label>
                    <textarea name="nota" rows="5" required x-model="nota"
                              class="input-field resize-none">{{ old('nota', $solicitud->nota) }}</textarea>

                    <div class="flex items-center gap-3 mt-2.5 flex-wrap">
                        <button type="button"
                                @click="obtenerRecomendacion()"
                                :disabled="cargando || nota.length < 10"
                                class="flex items-center gap-2 px-4 py-2
                                       bg-violet-600 hover:bg-violet-700
                                       disabled:opacity-40 disabled:cursor-not-allowed
                                       text-white text-xs font-semibold rounded-xl transition-colors shadow-sm">
                            <svg class="w-3.5 h-3.5" :class="cargando ? 'animate-spin' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                            <span x-text="cargando ? 'Analizando…' : 'Nueva recomendación IA'"></span>
                        </button>
                        <div x-show="prioridad" x-transition class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full inline-block" :class="dotClass"></span>
                            <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full border" :class="badgeClass"
                                  x-text="prioridadLabel || prioridad.toUpperCase()"></span>
                            <span x-show="categoria" class="text-xs text-gray-400" x-text="'· ' + categoria"></span>
                        </div>
                    </div>
                    <p x-show="errorMsg" x-text="errorMsg" class="text-xs text-amber-600 dark:text-amber-400 mt-1.5 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800/50 px-3 py-1.5 rounded-lg"></p>
                </div>

                {{-- Resultado IA nuevo --}}
                <div x-show="recomendacion" x-transition>
                    <div class="rounded-xl overflow-hidden border"
                         :class="prioridad === 'alta' ? 'border-red-200 dark:border-red-800/50'
                                 : (prioridad === 'media' ? 'border-orange-200 dark:border-orange-800/50'
                                 : 'border-emerald-200 dark:border-emerald-800/50')">
                        <div class="px-4 py-2.5 flex items-center gap-2"
                             :class="prioridad === 'alta' ? 'bg-red-50 dark:bg-red-900/20'
                                     : (prioridad === 'media' ? 'bg-orange-50 dark:bg-orange-900/20'
                                     : 'bg-emerald-50 dark:bg-emerald-900/20')">
                            <span class="w-2 h-2 rounded-full" :class="dotClass"></span>
                            <span class="text-xs font-bold uppercase"
                                  :class="prioridad === 'alta' ? 'text-red-700 dark:text-red-400'
                                          : (prioridad === 'media' ? 'text-orange-700 dark:text-orange-400'
                                          : 'text-emerald-700 dark:text-emerald-400')"
                                  x-text="'Prioridad ' + (prioridadLabel || prioridad)"></span>
                            <span x-show="categoria" x-text="categoria"
                                  class="ml-auto text-xs px-2 py-0.5 rounded-full bg-white/60 dark:bg-white/10
                                         text-gray-600 dark:text-gray-400 font-medium"></span>
                        </div>
                        <div class="px-4 py-3 bg-white dark:bg-[#161e2e]">
                            <p class="text-xs font-semibold text-gray-400 mb-1 uppercase tracking-wide">Recomendación:</p>
                            <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed" x-text="recomendacion"></p>
                        </div>
                    </div>
                    <input type="hidden" name="recomendacion_ia" :value="recomendacion"/>
                    <input type="hidden" name="prioridad_ia" :value="prioridad"/>
                </div>

                {{-- IA actual (solo si no hay nueva) --}}
                @if($solicitud->recomendacion_ia && !old('recomendacion_ia'))
                <div class="rounded-xl overflow-hidden border border-violet-200 dark:border-violet-800/50">
                    <div class="px-4 py-2.5 bg-violet-50 dark:bg-violet-900/20 flex items-center gap-2">
                        <svg class="w-3.5 h-3.5 text-violet-600 dark:text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                        <span class="text-xs font-bold text-violet-700 dark:text-violet-400">Recomendación IA actual</span>
                    </div>
                    <div class="px-4 py-3 bg-white dark:bg-[#161e2e]">
                        <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap">{{ $solicitud->recomendacion_ia }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- ── Seguimiento ── --}}
        <div class="bg-white dark:bg-[#161e2e] rounded-2xl border border-gray-100 dark:border-white/5
                    shadow-[0_2px_12px_rgba(0,0,0,.06)] dark:shadow-[0_2px_12px_rgba(0,0,0,.3)] overflow-hidden">
            <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100 dark:border-white/5">
                <div class="w-7 h-7 rounded-lg bg-blue-500/10 flex items-center justify-center flex-shrink-0">
                    <svg class="w-3.5 h-3.5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/>
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Notas de seguimiento</h3>
                <span class="ml-auto text-xs text-gray-400">Opcional</span>
            </div>
            <div class="p-5">
                <textarea name="seguimiento" rows="3"
                          placeholder="Registre acciones tomadas, observaciones de seguimiento, compromisos del aprendiz…"
                          class="input-field resize-none">{{ old('seguimiento', $solicitud->seguimiento) }}</textarea>
            </div>
        </div>

        {{-- Botones --}}
        <div class="flex items-center justify-between pt-1">
            <a href="{{ route('solicitudes.show', $solicitud) }}"
               class="px-5 py-2.5 text-sm font-medium text-gray-500 dark:text-gray-400
                      hover:text-gray-700 dark:hover:text-gray-200
                      border border-gray-200 dark:border-white/10
                      rounded-xl transition-colors bg-white dark:bg-[#161e2e]">
                Cancelar
            </a>
            <button type="submit"
                    class="px-7 py-2.5 bg-sena-500 hover:bg-sena-600
                           text-white text-sm font-semibold rounded-xl
                           transition-all shadow-[0_4px_14px_rgba(57,169,0,.35)]
                           hover:shadow-[0_6px_20px_rgba(57,169,0,.45)]
                           flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Guardar cambios
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
function solicitudForm() {
    return {
        nota: `{{ addslashes(old('nota', $solicitud->nota)) }}`,
        recomendacion: '',
        prioridad: '{{ $solicitud->prioridad }}',
        prioridadLabel: '{{ ucfirst($solicitud->prioridad) }}',
        color: '',
        categoria: '',
        cargando: false,
        errorMsg: '',
        async obtenerRecomendacion() {
            if (this.nota.length < 10) return;
            this.cargando = true;
            this.errorMsg = '';
            try {
                const resp = await fetch('{{ route('ia.recomendar') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ nota: this.nota }),
                });
                const data = await resp.json();
                this.recomendacion  = data.recomendacion;
                this.prioridad      = data.prioridad;
                this.prioridadLabel = data.prioridad_label || data.prioridad;
                this.color          = data.color || '';
                this.categoria      = data.categoria || '';
                if (data.error) this.errorMsg = '⚠ IA saturada — se usó análisis local. ' + data.error;
            } catch (e) {
                this.errorMsg = 'No se pudo obtener la recomendación.';
            } finally {
                this.cargando = false;
            }
        },
        get badgeClass() {
            if (this.prioridad === 'alta')  return 'bg-red-50 text-red-700 border-red-200 dark:bg-red-900/20 dark:text-red-400 dark:border-red-800';
            if (this.prioridad === 'media') return 'bg-orange-50 text-orange-700 border-orange-200 dark:bg-orange-900/20 dark:text-orange-400 dark:border-orange-800';
            return 'bg-emerald-50 text-emerald-700 border-emerald-200 dark:bg-emerald-900/20 dark:text-emerald-400 dark:border-emerald-800';
        },
        get dotClass() {
            if (this.prioridad === 'alta')  return 'bg-red-500';
            if (this.prioridad === 'media') return 'bg-orange-400';
            return 'bg-emerald-500';
        }
    }
}
</script>
@endpush

@endsection
