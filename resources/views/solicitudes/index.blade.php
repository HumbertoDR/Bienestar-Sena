@extends('layouts.app')

@section('title', 'Solicitudes')
@section('page-title', 'Solicitudes')

@section('content')

{{-- ── Filtros ── --}}
<div class="bg-white dark:bg-[#161e2e] rounded-2xl border border-gray-100 dark:border-white/5
            shadow-[0_2px_12px_rgba(0,0,0,.06)] dark:shadow-[0_2px_12px_rgba(0,0,0,.3)]
            p-4 mb-5">
    <form method="GET" action="{{ route('solicitudes.index') }}"
          class="flex flex-wrap gap-3 items-end">

        {{-- Búsqueda --}}
        <div class="flex-1 min-w-[180px]">
            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1.5">Buscar</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" name="buscar" value="{{ request('buscar') }}"
                       placeholder="Nombre, documento o ficha…"
                       class="input-field pl-9"/>
            </div>
        </div>

        {{-- Estado --}}
        <div class="min-w-[130px]">
            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1.5">Estado</label>
            <select name="estado" class="input-field">
                <option value="">Todos los estados</option>
                <option value="pendiente"       {{ request('estado') === 'pendiente'       ? 'selected' : '' }}>Pendiente</option>
                <option value="en_seguimiento"  {{ request('estado') === 'en_seguimiento'  ? 'selected' : '' }}>En seguimiento</option>
                <option value="cerrado"         {{ request('estado') === 'cerrado'         ? 'selected' : '' }}>Cerrado</option>
            </select>
        </div>

        {{-- Prioridad --}}
        <div class="min-w-[130px]">
            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1.5">Prioridad</label>
            <select name="prioridad" class="input-field">
                <option value="">Todas</option>
                <option value="alta"  {{ request('prioridad') === 'alta'  ? 'selected' : '' }}>🔴 Alta</option>
                <option value="media" {{ request('prioridad') === 'media' ? 'selected' : '' }}>🟠 Media</option>
                <option value="baja"  {{ request('prioridad') === 'baja'  ? 'selected' : '' }}>🟢 Baja</option>
            </select>
        </div>

        {{-- Categoría --}}
        <div class="min-w-[140px]">
            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1.5">Categoría</label>
            <select name="categoria" class="input-field">
                <option value="">Todas</option>
                <option value="academico"   {{ request('categoria') === 'academico'   ? 'selected' : '' }}>Académico</option>
                <option value="salud_mental"{{ request('categoria') === 'salud_mental'? 'selected' : '' }}>Salud Mental</option>
                <option value="economico"   {{ request('categoria') === 'economico'   ? 'selected' : '' }}>Económico</option>
                <option value="personal"    {{ request('categoria') === 'personal'    ? 'selected' : '' }}>Personal</option>
                <option value="otro"        {{ request('categoria') === 'otro'        ? 'selected' : '' }}>Otro</option>
            </select>
        </div>

        {{-- Botones filtro --}}
        <div class="flex gap-2">
            <button type="submit"
                    class="h-[38px] px-4 bg-sena-500 hover:bg-sena-600 active:bg-sena-700
                           text-white text-sm font-medium rounded-xl transition-colors
                           flex items-center gap-1.5 shadow-sm">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                Filtrar
            </button>
            @if(request()->hasAny(['buscar','estado','prioridad','categoria']))
            <a href="{{ route('solicitudes.index') }}"
               class="h-[38px] px-4 bg-gray-100 dark:bg-white/5 hover:bg-gray-200 dark:hover:bg-white/10
                      text-gray-600 dark:text-gray-400 text-sm font-medium rounded-xl transition-colors
                      flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Limpiar
            </a>
            @endif
        </div>

        {{-- Acciones derecha --}}
        <div class="ml-auto flex gap-2">
            <a href="{{ route('solicitudes.excel') }}"
               class="h-[38px] px-4 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium
                      rounded-xl transition-colors flex items-center gap-1.5 shadow-sm">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Excel
            </a>
            <a href="{{ route('solicitudes.create') }}"
               class="h-[38px] px-4 bg-sena-500 hover:bg-sena-600 text-white text-sm font-medium
                      rounded-xl transition-colors flex items-center gap-1.5 shadow-sm">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nueva
            </a>
        </div>
    </form>
</div>

{{-- ── Tabla ── --}}
<div class="bg-white dark:bg-[#161e2e] rounded-2xl border border-gray-100 dark:border-white/5
            shadow-[0_2px_12px_rgba(0,0,0,.06)] dark:shadow-[0_2px_12px_rgba(0,0,0,.3)]
            overflow-hidden">

    {{-- Conteo --}}
    <div class="px-5 py-3.5 border-b border-gray-100 dark:border-white/5 flex items-center justify-between">
        <p class="text-sm text-gray-500 dark:text-gray-400">
            <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $solicitudes->total() }}</span>
            solicitudes encontradas
        </p>
        @if(request()->hasAny(['buscar','estado','prioridad','categoria']))
        <span class="text-xs px-2.5 py-1 bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400
                     border border-amber-200 dark:border-amber-800/50 rounded-full font-medium">
            Filtros activos
        </span>
        @endif
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50/70 dark:bg-white/3 border-b border-gray-100 dark:border-white/5">
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider w-10">P.</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Aprendiz</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Ficha</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider hidden md:table-cell">Fecha</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider hidden lg:table-cell">Categoría</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Estado</th>
                    <th class="px-5 py-3 text-right text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 dark:divide-white/3">
                @forelse($solicitudes as $s)
                <tr class="hover:bg-gray-50/70 dark:hover:bg-white/3 transition-colors group">

                    {{-- Semáforo --}}
                    <td class="px-5 py-3.5">
                        <div class="relative">
                            <span class="inline-flex items-center justify-center w-5 h-5 rounded-full shadow-sm
                                {{ $s->prioridad === 'alta'
                                   ? 'bg-red-500 shadow-red-200 dark:shadow-red-900'
                                   : ($s->prioridad === 'media'
                                      ? 'bg-orange-400 shadow-orange-200 dark:shadow-orange-900'
                                      : 'bg-emerald-500 shadow-emerald-200 dark:shadow-emerald-900') }}"
                                  title="Prioridad {{ ucfirst($s->prioridad) }}">
                            </span>
                        </div>
                    </td>

                    {{-- Aprendiz --}}
                    <td class="px-5 py-3.5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center text-white font-bold text-xs flex-shrink-0
                                {{ $s->prioridad === 'alta'
                                   ? 'bg-gradient-to-br from-red-400 to-red-600'
                                   : ($s->prioridad === 'media'
                                      ? 'bg-gradient-to-br from-orange-400 to-orange-500'
                                      : 'bg-gradient-to-br from-sena-400 to-sena-600') }}">
                                {{ strtoupper(substr($s->nombre, 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-gray-800 dark:text-gray-200 truncate
                                          group-hover:text-sena-600 dark:group-hover:text-sena-400 transition-colors">
                                    {{ $s->nombre_completo }}
                                </p>
                                @if($s->documento)
                                <p class="text-xs text-gray-400 dark:text-gray-500">Doc: {{ $s->documento }}</p>
                                @endif
                            </div>
                        </div>
                    </td>

                    {{-- Ficha --}}
                    <td class="px-5 py-3.5">
                        <span class="font-mono text-xs bg-sena-500/8 dark:bg-sena-500/10
                                     text-sena-600 dark:text-sena-400
                                     px-2.5 py-1 rounded-lg">
                            {{ $s->ficha_programa }}
                        </span>
                    </td>

                    {{-- Fecha --}}
                    <td class="px-5 py-3.5 hidden md:table-cell">
                        <span class="text-sm text-gray-600 dark:text-gray-400 whitespace-nowrap">
                            {{ $s->fecha->format('d/m/Y') }}
                        </span>
                    </td>

                    {{-- Categoría --}}
                    <td class="px-5 py-3.5 hidden lg:table-cell">
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $s->label_categoria }}</span>
                    </td>

                    {{-- Estado --}}
                    <td class="px-5 py-3.5">
                        <span class="inline-flex items-center text-xs px-2.5 py-1 rounded-full font-medium
                            {{ $s->estado === 'cerrado'
                               ? 'bg-gray-100 dark:bg-white/8 text-gray-600 dark:text-gray-400'
                               : ($s->estado === 'en_seguimiento'
                                  ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400'
                                  : 'bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400') }}">
                            <span class="w-1.5 h-1.5 rounded-full mr-1.5
                                {{ $s->estado === 'cerrado' ? 'bg-gray-400'
                                   : ($s->estado === 'en_seguimiento' ? 'bg-blue-500' : 'bg-amber-500') }}">
                            </span>
                            {{ $s->label_estado }}
                        </span>
                    </td>

                    {{-- Acciones --}}
                    <td class="px-5 py-3.5 text-right whitespace-nowrap">
                        <div class="flex items-center justify-end gap-1">
                            <a href="{{ route('solicitudes.show', $s) }}"
                               class="w-7 h-7 flex items-center justify-center rounded-lg
                                      text-gray-400 hover:text-sena-600 dark:hover:text-sena-400
                                      hover:bg-sena-500/10 transition-colors"
                               title="Ver detalle">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            <a href="{{ route('solicitudes.edit', $s) }}"
                               class="w-7 h-7 flex items-center justify-center rounded-lg
                                      text-gray-400 hover:text-blue-600 dark:hover:text-blue-400
                                      hover:bg-blue-500/10 transition-colors"
                               title="Editar">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <a href="{{ route('solicitudes.pdf', $s) }}"
                               class="w-7 h-7 flex items-center justify-center rounded-lg
                                      text-gray-400 hover:text-red-600 dark:hover:text-red-400
                                      hover:bg-red-500/10 transition-colors"
                               title="PDF" target="_blank">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                            </a>
                            <form method="POST" action="{{ route('solicitudes.destroy', $s) }}" class="inline"
                                  onsubmit="return confirm('¿Eliminar esta solicitud? Esta acción no se puede deshacer.')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="w-7 h-7 flex items-center justify-center rounded-lg
                                               text-gray-400 hover:text-red-600 dark:hover:text-red-400
                                               hover:bg-red-500/10 transition-colors"
                                        title="Eliminar">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-5 py-16 text-center">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-16 h-16 rounded-2xl bg-gray-50 dark:bg-white/5 flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">Sin resultados</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">No se encontraron solicitudes con los filtros aplicados.</p>
                            </div>
                            <a href="{{ route('solicitudes.create') }}"
                               class="mt-1 text-sm font-medium text-sena-600 dark:text-sena-400 hover:underline">
                                Registrar primera solicitud →
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($solicitudes->hasPages())
    <div class="px-5 py-3.5 border-t border-gray-100 dark:border-white/5">
        {{ $solicitudes->links() }}
    </div>
    @endif
</div>

@endsection
