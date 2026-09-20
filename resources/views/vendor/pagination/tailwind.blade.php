@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 text-sm text-gray-400 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg cursor-default">
                    Anterior
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                    Anterior
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                    Siguiente
                </a>
            @else
                <span class="px-4 py-2 text-sm text-gray-400 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg cursor-default">
                    Siguiente
                </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Mostrando
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    a
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    de
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    resultados
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex rounded-md shadow-sm gap-1">
                    {{-- Previous --}}
                    @if ($paginator->onFirstPage())
                        <span class="px-3 py-1.5 text-sm text-gray-400 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg cursor-default">«</span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}"
                           class="px-3 py-1.5 text-sm text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">«</a>
                    @endif

                    {{-- Pages --}}
                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <span class="px-3 py-1.5 text-sm text-gray-500 dark:text-gray-400">{{ $element }}</span>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span class="px-3 py-1.5 text-sm font-medium text-white bg-sena-green border border-sena-green rounded-lg">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}"
                                       class="px-3 py-1.5 text-sm text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}"
                           class="px-3 py-1.5 text-sm text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">»</a>
                    @else
                        <span class="px-3 py-1.5 text-sm text-gray-400 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg cursor-default">»</span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
