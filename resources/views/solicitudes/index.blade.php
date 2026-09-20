@extends('layouts.app')

@section('title', 'Solicitudes')
@section('page-title', 'Listado de Solicitudes')

@section('content')

{{-- Filtros y acciones --}}
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-4 mb-5">
    <form method="GET" action="{{ route('solicitudes.index') }}" class="flex flex-wrap gap-3 items-end">
        <div class="flex-1 min-w-[180px]">
            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Buscar</label>
            <input type="text" name="buscar" value="{{ request('buscar') }}"
                   placeholder="Nombre, documento o ficha…"
                   class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600
                          bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                          focus:outline-none focus:ring-2 focus:ring-sena-green focus:border-transparent"/>
        </div>
        <div class="min-w-[130px]">
            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Estado</label>
            <select name="estado"
                    class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600
                           bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                           focus:outline-none focus:ring-2 focus:ring-sena-green">
                <option value="">Todos</option>
                <option value="pendiente" {{ request('estado') === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="en_seguimiento" {{ request('estado') === 'en_seguimiento' ? 'selected' : '' }}>En seguimiento</option>
                <option value="cerrado" {{ request('estado') === 'cerrado' ? 'selected' : '' }}>Cerrado</option>
            </select>
        </div>
        <div class="min-w-[130px]">
            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Prioridad</label>
            <select name="prioridad"
                    class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600
                           bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                           focus:outline-none focus:ring-2 focus:ring-sena-green">
                <option value="">Todas</option>
                <option value="alta" {{ request('prioridad') === 'alta' ? 'selected' : '' }}>🔴 Alta</option>
                <option value="media" {{ request('prioridad') === 'media' ? 'selected' : '' }}>🟠 Media</option>
                <option value="baja" {{ request('prioridad') === 'baja' ? 'selected' : '' }}>🟢 Baja</option>
            </select>
        </div>
        <div class="min-w-[130px]">
            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Categoría</label>
            <select name="categoria"
                    class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600
                           bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                           focus:outline-none focus:ring-2 focus:ring-sena-green">
                <option value="">Todas</option>
                <option value="academico" {{ request('categoria') === 'academico' ? 'selected' : '' }}>Académico</option>
                <option value="salud_mental" {{ request('categoria') === 'salud_mental' ? 'selected' : '' }}>Salud Mental</option>
                <option value="economico" {{ request('categoria') === 'economico' ? 'selected' : '' }}>Económico</option>
                <option value="personal" {{ request('categoria') === 'personal' ? 'selected' : '' }}>Personal</option>
                <option value="otro" {{ request('categoria') === 'otro' ? 'selected' : '' }}>Otro</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit"
                    class="px-4 py-2 bg-sena-green hover:bg-sena-dark text-white text-sm font-medium
                           rounded-lg transition-colors">
                Filtrar
            </button>
            @if(request()->hasAny(['buscar','estado','prioridad','categoria']))
                <a href="{{ route('solicitudes.index') }}"
                   class="px-4 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600
                          text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg transition-colors">
                    Limpiar
                </a>
            @endif
        </div>

        <div class="ml-auto flex gap-2">
            <a href="{{ route('solicitudes.excel') }}"
               class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium
                      rounded-lg transition-colors flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Excel
            </a>
            <a href="{{ route('solicitudes.create') }}"
               class="px-4 py-2 bg-sena-green hover:bg-sena-dark text-white text-sm font-medium
                      rounded-lg transition-colors flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nueva
            </a>
        </div>
    </form>
</div>

{{-- Tabla --}}
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-100 dark:border-gray-700">
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider w-8">P.</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Aprendiz</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Ficha</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider hidden md:table-cell">Fecha</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider hidden lg:table-cell">Categoría</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Estado</th>
                    <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($solicitudes as $s)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                        {{-- Semáforo --}}
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center justify-center w-5 h-5 rounded-full
                                {{ $s->prioridad === 'alta' ? 'bg-red-500' : ($s->prioridad === 'media' ? 'bg-orange-400' : 'bg-green-500') }}"
                                  title="Prioridad: {{ ucfirst($s->prioridad) }}">
                            </span>
                        </td>

                        {{-- Aprendiz --}}
                        <td class="px-4 py-3">
                            <p class="font-medium text-gray-900 dark:text-white">{{ $s->nombre_completo }}</p>
                            @if($s->documento)
                                <p class="text-xs text-gray-500 dark:text-gray-400">Doc: {{ $s->documento }}</p>
                            @endif
                        </td>

                        {{-- Ficha --}}
                        <td class="px-4 py-3">
                            <span class="font-mono text-xs bg-gray-100 dark:bg-gray-700 px-2 py-0.5 rounded">
                                {{ $s->ficha_programa }}
                            </span>
                        </td>

                        {{-- Fecha --}}
                        <td class="px-4 py-3 hidden md:table-cell text-gray-600 dark:text-gray-400 whitespace-nowrap">
                            {{ $s->fecha->format('d/m/Y') }}
                        </td>

                        {{-- Categoría --}}
                        <td class="px-4 py-3 hidden lg:table-cell text-gray-600 dark:text-gray-400">
                            {{ $s->label_categoria }}
                        </td>

                        {{-- Estado --}}
                        <td class="px-4 py-3">
                            <span class="inline-block text-xs px-2 py-0.5 rounded-full font-medium
                                {{ $s->estado === 'cerrado'
                                   ? 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400'
                                   : ($s->estado === 'en_seguimiento'
                                      ? 'bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-400'
                                      : 'bg-yellow-100 dark:bg-yellow-900/40 text-yellow-700 dark:text-yellow-400') }}">
                                {{ $s->label_estado }}
                            </span>
                        </td>

                        {{-- Acciones --}}
                        <td class="px-4 py-3 text-right whitespace-nowrap">
                            <a href="{{ route('solicitudes.show', $s) }}"
                               class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-sena-green
                                      hover:text-white hover:bg-sena-green rounded transition-colors"
                               title="Ver detalle">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            <a href="{{ route('solicitudes.edit', $s) }}"
                               class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-blue-600
                                      hover:text-white hover:bg-blue-600 rounded transition-colors"
                               title="Editar">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <a href="{{ route('solicitudes.pdf', $s) }}"
                               class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-red-600
                                      hover:text-white hover:bg-red-600 rounded transition-colors"
                               title="Descargar PDF"
                               target="_blank">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                            </a>
                            <form method="POST" action="{{ route('solicitudes.destroy', $s) }}" class="inline"
                                  onsubmit="return confirm('¿Eliminar esta solicitud? Esta acción no se puede deshacer.')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-gray-500
                                               hover:text-white hover:bg-red-500 rounded transition-colors"
                                        title="Eliminar">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-12 text-center text-gray-400 dark:text-gray-500">
                            <svg class="w-12 h-12 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <p class="text-sm">No se encontraron solicitudes.</p>
                            <a href="{{ route('solicitudes.create') }}" class="mt-2 inline-block text-sena-green hover:underline text-sm">
                                Registrar primera solicitud
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($solicitudes->hasPages())
        <div class="px-4 py-3 border-t border-gray-100 dark:border-gray-700">
            {{ $solicitudes->links() }}
        </div>
    @endif
</div>

@endsection
