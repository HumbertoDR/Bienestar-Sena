@extends('layouts.app')

@section('title', 'Nueva Solicitud')
@section('page-title', 'Registrar Nueva Solicitud')

@section('content')

<div class="max-w-3xl mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">

        {{-- Header --}}
        <div class="bg-sena-green px-6 py-4">
            <h2 class="text-white font-semibold text-lg">Registro de Caso — Bienestar al Aprendiz</h2>
            <p class="text-green-100 text-sm">Complete todos los campos del formulario</p>
        </div>

        <form method="POST" action="{{ route('solicitudes.store') }}" class="p-6 space-y-5"
              x-data="solicitudForm()">

            {{-- Datos personales --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Nombre <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" required
                           class="input-field @error('nombre') border-red-500 @enderror"/>
                    @error('nombre') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Apellido <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="apellido" value="{{ old('apellido') }}" required
                           class="input-field @error('apellido') border-red-500 @enderror"/>
                    @error('apellido') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        N° Documento
                    </label>
                    <input type="text" name="documento" value="{{ old('documento') }}"
                           placeholder="CC / TI"
                           class="input-field @error('documento') border-red-500 @enderror"/>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Ficha de Programa <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="ficha_programa" value="{{ old('ficha_programa') }}" required
                           placeholder="Ej: 2345678"
                           class="input-field font-mono @error('ficha_programa') border-red-500 @enderror"/>
                    @error('ficha_programa') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Edad <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="edad" value="{{ old('edad') }}" required
                           min="14" max="100"
                           class="input-field @error('edad') border-red-500 @enderror"/>
                    @error('edad') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Nombre del Programa
                    </label>
                    <input type="text" name="nombre_programa" value="{{ old('nombre_programa') }}"
                           placeholder="Ej: Tecnología en Desarrollo de Software"
                           class="input-field"/>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Fecha de Atención <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="fecha" value="{{ old('fecha', date('Y-m-d')) }}" required
                           class="input-field @error('fecha') border-red-500 @enderror"/>
                    @error('fecha') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Categoría del Caso <span class="text-red-500">*</span>
                    </label>
                    <select name="categoria" required class="input-field">
                        <option value="">Seleccionar…</option>
                        <option value="academico" {{ old('categoria') === 'academico' ? 'selected' : '' }}>Académico</option>
                        <option value="salud_mental" {{ old('categoria') === 'salud_mental' ? 'selected' : '' }}>Salud Mental</option>
                        <option value="economico" {{ old('categoria') === 'economico' ? 'selected' : '' }}>Económico</option>
                        <option value="personal" {{ old('categoria') === 'personal' ? 'selected' : '' }}>Personal</option>
                        <option value="otro" {{ old('categoria') === 'otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                    @error('categoria') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Estado Inicial <span class="text-red-500">*</span>
                    </label>
                    <select name="estado" required class="input-field">
                        <option value="pendiente" selected>Pendiente</option>
                        <option value="en_seguimiento">En seguimiento</option>
                        <option value="cerrado">Cerrado</option>
                    </select>
                </div>
            </div>

            {{-- Nota descriptiva + IA --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Nota Descriptiva del Caso <span class="text-red-500">*</span>
                </label>
                <textarea name="nota" rows="4" required
                          x-model="nota"
                          placeholder="Describa detalladamente la situación del aprendiz, motivo de la visita, observaciones relevantes…"
                          class="input-field resize-none @error('nota') border-red-500 @enderror">{{ old('nota') }}</textarea>
                @error('nota') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

                {{-- Botón IA --}}
                <div class="flex items-center gap-3 mt-2">
                    <button type="button"
                            @click="obtenerRecomendacion()"
                            :disabled="cargando || nota.length < 10"
                            class="flex items-center gap-2 px-4 py-2 bg-purple-600 hover:bg-purple-700
                                   disabled:opacity-50 disabled:cursor-not-allowed
                                   text-white text-sm font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4" :class="cargando ? 'animate-spin' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                        <span x-text="cargando ? 'Analizando con IA...' : 'Recomendación IA'"></span>
                    </button>

                    {{-- Semáforo resultado --}}
                    <div x-show="prioridad" x-transition class="flex items-center gap-2">
                        <span class="w-3.5 h-3.5 rounded-full inline-block shadow-sm" :class="dotClass"></span>
                        <span class="text-xs font-semibold px-2 py-0.5 rounded-full" :class="badgeClass"
                              x-text="prioridadLabel || prioridad.toUpperCase()">
                        </span>
                        <span x-show="categoria" class="text-xs text-gray-500 dark:text-gray-400"
                              x-text="'· ' + categoria"></span>
                    </div>
                </div>

                {{-- Error fallback --}}
                <p x-show="errorMsg" x-text="errorMsg"
                   class="text-xs text-orange-600 dark:text-orange-400 mt-1"></p>
            </div>

            {{-- Tarjeta resultado IA --}}
            <div x-show="recomendacion" x-transition>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Análisis IA — Bienestar al Aprendiz SENA
                </label>
                <div class="border rounded-xl overflow-hidden"
                     :class="prioridad === 'alta' ? 'border-red-300 dark:border-red-700'
                             : (prioridad === 'media' ? 'border-orange-300 dark:border-orange-700'
                             : 'border-green-300 dark:border-green-700')">
                    {{-- Cabecera de color --}}
                    <div class="flex items-center justify-between px-4 py-2"
                         :class="prioridad === 'alta' ? 'bg-red-50 dark:bg-red-900/30'
                                 : (prioridad === 'media' ? 'bg-orange-50 dark:bg-orange-900/30'
                                 : 'bg-green-50 dark:bg-green-900/30')">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full" :class="dotClass"></span>
                            <span class="text-xs font-bold uppercase tracking-wide"
                                  :class="prioridad === 'alta' ? 'text-red-700 dark:text-red-300'
                                          : (prioridad === 'media' ? 'text-orange-700 dark:text-orange-300'
                                          : 'text-green-700 dark:text-green-300')"
                                  x-text="'Prioridad ' + (prioridadLabel || prioridad)"></span>
                        </div>
                        <div class="flex items-center gap-3 text-xs text-gray-500 dark:text-gray-400">
                            <span x-show="color" x-text="'Color: ' + color"></span>
                            <span x-show="categoria" x-text="categoria"
                                  class="px-2 py-0.5 rounded-full bg-white/60 dark:bg-gray-700/60 font-medium"></span>
                        </div>
                    </div>
                    {{-- Recomendación --}}
                    <div class="px-4 py-3 bg-white dark:bg-gray-800">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Recomendación para el profesional:</p>
                        <p class="text-sm text-gray-800 dark:text-gray-200 leading-relaxed" x-text="recomendacion"></p>
                    </div>
                </div>
                <input type="hidden" name="recomendacion_ia" :value="recomendacion"/>
                <input type="hidden" name="prioridad_ia" :value="prioridad"/>
            </div>

            {{-- Botones --}}
            <div class="flex items-center justify-between pt-2 border-t border-gray-100 dark:border-gray-700">
                <a href="{{ route('solicitudes.index') }}"
                   class="px-5 py-2 text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200
                          border border-gray-300 dark:border-gray-600 rounded-lg transition-colors">
                    Cancelar
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-sena-green hover:bg-sena-dark text-white text-sm font-semibold
                               rounded-lg transition-colors shadow-sm">
                    Guardar Solicitud
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.input-field {
    width: 100%;
    padding: 0.5rem 0.75rem;
    font-size: 0.875rem;
    border-radius: 0.5rem;
    border: 1px solid #d1d5db;
    background-color: #ffffff;
    color: #111827;
    transition: border-color 0.15s, box-shadow 0.15s;
    outline: none;
}
.input-field:focus {
    border-color: #39A900;
    box-shadow: 0 0 0 2px rgba(57,169,0,0.25);
}
.input-field.border-red-500 { border-color: #ef4444; }
.dark .input-field {
    background-color: #374151;
    border-color: #4b5563;
    color: #f9fafb;
}
.dark .input-field:focus {
    border-color: #39A900;
    box-shadow: 0 0 0 2px rgba(57,169,0,0.25);
}
</style>

@push('scripts')
<script>
function solicitudForm() {
    return {
        nota: '{{ old('nota') }}',
        recomendacion: '{{ old('recomendacion_ia') }}',
        prioridad: '',
        prioridadLabel: '',
        color: '',
        categoria: '',
        cargando: false,
        errorMsg: '',

        async obtenerRecomendacion() {
            if (this.nota.length < 10) return;
            this.cargando  = true;
            this.errorMsg  = '';
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
                if (data.error) this.errorMsg = data.error;
            } catch (e) {
                this.errorMsg = 'No se pudo obtener la recomendación. Inténtalo de nuevo.';
            } finally {
                this.cargando = false;
            }
        },

        get badgeClass() {
            if (this.prioridad === 'alta')  return 'bg-red-100 text-red-800 border border-red-300';
            if (this.prioridad === 'media') return 'bg-orange-100 text-orange-800 border border-orange-300';
            return 'bg-green-100 text-green-800 border border-green-300';
        },

        get dotClass() {
            if (this.prioridad === 'alta')  return 'bg-red-500';
            if (this.prioridad === 'media') return 'bg-orange-400';
            return 'bg-green-500';
        }
    }
}
</script>
@endpush

@endsection
