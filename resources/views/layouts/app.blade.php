<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Bienestar al Aprendiz') — SENA</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        sena: {
                            green: '#39A900',
                            dark:  '#2d8200',
                            light: '#e8f7e0',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        if (localStorage.theme === 'dark' ||
            (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="h-full bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100"
      x-data="{ sidebarOpen: false }">

    <!-- Mobile overlay -->
    <div x-show="sidebarOpen"
         x-cloak
         @click="sidebarOpen = false"
         class="fixed inset-0 bg-black/50 z-20 lg:hidden"></div>

    <div class="flex h-full min-h-screen">

        <!-- ===== SIDEBAR ===== -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
               class="fixed inset-y-0 left-0 z-30 w-64 flex flex-col
                      bg-[#39A900] shadow-xl
                      transform transition-transform duration-200 ease-in-out
                      lg:relative lg:translate-x-0 lg:flex lg:flex-shrink-0">

            <!-- Logo -->
            <div class="flex items-center gap-3 px-5 py-5 border-b border-[#2d8200]">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow flex-shrink-0">
                    <span class="text-[#39A900] font-black text-xs">SENA</span>
                </div>
                <div>
                    <p class="text-white font-bold text-sm leading-tight">Bienestar</p>
                    <p class="text-green-100 text-xs">al Aprendiz</p>
                </div>
            </div>

            <!-- Nav links -->
            <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">

                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors
                          {{ request()->routeIs('dashboard')
                             ? 'bg-white text-[#39A900] shadow-sm'
                             : 'text-green-100 hover:bg-[#2d8200] hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('solicitudes.create') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors
                          {{ request()->routeIs('solicitudes.create')
                             ? 'bg-white text-[#39A900] shadow-sm'
                             : 'text-green-100 hover:bg-[#2d8200] hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Nueva Solicitud</span>
                </a>

                <a href="{{ route('solicitudes.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors
                          {{ request()->routeIs('solicitudes.index', 'solicitudes.show', 'solicitudes.edit')
                             ? 'bg-white text-[#39A900] shadow-sm'
                             : 'text-green-100 hover:bg-[#2d8200] hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <span>Solicitudes</span>
                </a>

                <a href="{{ route('solicitudes.historial') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors
                          {{ request()->routeIs('solicitudes.historial')
                             ? 'bg-white text-[#39A900] shadow-sm'
                             : 'text-green-100 hover:bg-[#2d8200] hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Historial</span>
                </a>

                <div class="pt-4 pb-1">
                    <p class="px-4 text-xs font-semibold text-green-200 uppercase tracking-wider">Reportes</p>
                </div>

                <a href="{{ route('solicitudes.excel') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors
                          text-green-100 hover:bg-[#2d8200] hover:text-white">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    <span>Exportar Excel</span>
                </a>

            </nav>

            <!-- User + logout -->
            <div class="px-4 py-4 border-t border-[#2d8200]">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center
                                text-white font-bold text-sm flex-shrink-0">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-white text-sm font-medium truncate">{{ auth()->user()->name }}</p>
                        <p class="text-green-200 text-xs truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center gap-2 px-3 py-2 rounded-lg text-sm
                                   text-green-100 hover:bg-[#2d8200] hover:text-white transition-colors">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </aside>

        <!-- ===== MAIN ===== -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

            <!-- Top bar -->
            <header class="sticky top-0 z-10 bg-white dark:bg-gray-800 shadow-sm
                           border-b border-gray-200 dark:border-gray-700 flex-shrink-0">
                <div class="flex items-center gap-4 px-4 py-3">

                    <!-- Hamburger (mobile) -->
                    <button @click="sidebarOpen = !sidebarOpen"
                            class="lg:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100
                                   dark:hover:bg-gray-700 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <h1 class="text-base font-semibold text-gray-800 dark:text-gray-100 truncate">
                        @yield('page-title', 'Bienestar al Aprendiz SENA')
                    </h1>

                    <div class="flex items-center gap-3 ml-auto flex-shrink-0">
                        <!-- Dark mode toggle -->
                        <button onclick="toggleDarkMode()"
                                class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700
                                       text-gray-600 dark:text-gray-300
                                       hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors"
                                title="Modo oscuro/claro">
                            <svg class="w-4 h-4 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M17.657 17.657l-.707-.707M6.343 6.343l-.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/>
                            </svg>
                            <svg class="w-4 h-4 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                            </svg>
                        </button>

                        <span class="text-xs text-gray-400 dark:text-gray-500 hidden sm:block whitespace-nowrap">
                            {{ now()->locale('es')->isoFormat('ddd, D MMM YYYY') }}
                        </span>
                    </div>
                </div>
            </header>

            <!-- Alerts -->
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition
                     class="mx-4 mt-4 flex items-center gap-3 bg-green-50 border border-green-200
                            text-green-800 dark:bg-green-900/30 dark:border-green-700 dark:text-green-300
                            rounded-lg px-4 py-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm font-medium flex-1">{{ session('success') }}</span>
                    <button @click="show = false" class="text-green-600 hover:text-green-900 ml-auto">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div x-data="{ show: true }" x-show="show" x-transition
                     class="mx-4 mt-4 flex items-center gap-3 bg-red-50 border border-red-200
                            text-red-800 dark:bg-red-900/30 dark:border-red-700 dark:text-red-300
                            rounded-lg px-4 py-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm font-medium flex-1">{{ session('error') }}</span>
                    <button @click="show = false" class="text-red-600 hover:text-red-900 ml-auto">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
            @endif

            <!-- Page content -->
            <main class="flex-1 overflow-y-auto p-4 lg:p-6">
                @yield('content')
            </main>

            <footer class="flex-shrink-0 text-center text-xs text-gray-400 dark:text-gray-600
                           py-3 border-t border-gray-200 dark:border-gray-700">
                SENA — Servicio Nacional de Aprendizaje · Bienestar al Aprendiz · {{ now()->year }}
            </footer>
        </div>
    </div>

    <script>
        function toggleDarkMode() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            }
        }
    </script>

    @stack('scripts')
</body>
</html>
