<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Bienestar al Aprendiz') — SENA</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui'],
                    },
                    colors: {
                        sena: {
                            50:    '#f0fce8',
                            100:   '#ddf9c4',
                            200:   '#bcf08d',
                            300:   '#93e04d',
                            400:   '#70ca20',
                            500:   '#39A900',
                            600:   '#2d8200',
                            700:   '#236500',
                            800:   '#1c5000',
                            900:   '#143800',
                        }
                    },
                    boxShadow: {
                        'card':  '0 1px 3px 0 rgba(0,0,0,.07), 0 1px 2px -1px rgba(0,0,0,.07)',
                        'card-lg': '0 4px 16px -2px rgba(0,0,0,.10), 0 2px 6px -2px rgba(0,0,0,.06)',
                        'glow-green': '0 0 20px rgba(57,169,0,.25)',
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
        // Aplicar tema oscuro antes de pintar para evitar flash
        if (localStorage.theme === 'dark' ||
            (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <style>
        /* ── Scrollbar personalizado ── */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 10px; }
        .dark ::-webkit-scrollbar-thumb { background: #374151; }

        /* ── Input field base ── */
        .input-field {
            width: 100%;
            padding: 0.55rem 0.875rem;
            font-size: 0.875rem;
            border-radius: 0.625rem;
            border: 1.5px solid #e5e7eb;
            background: #fff;
            color: #111827;
            transition: border-color .15s, box-shadow .15s;
            outline: none;
            font-family: 'Inter', sans-serif;
        }
        .input-field:focus {
            border-color: #39A900;
            box-shadow: 0 0 0 3px rgba(57,169,0,.15);
        }
        .input-field.border-red-500 { border-color: #ef4444; }
        .dark .input-field {
            background: #1e2533;
            border-color: #2d3748;
            color: #f1f5f9;
        }
        .dark .input-field:focus {
            border-color: #39A900;
            box-shadow: 0 0 0 3px rgba(57,169,0,.2);
        }
        .dark .input-field::placeholder { color: #4b5563; }

        /* ── Sidebar nav item activo ── */
        .nav-active {
            background: rgba(255,255,255,0.18) !important;
            color: #fff !important;
            font-weight: 600;
        }
        .nav-item {
            transition: background .15s, color .15s, transform .1s;
        }
        .nav-item:hover { transform: translateX(2px); }

        /* ── Badge base ── */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.2rem 0.6rem;
            border-radius: 999px;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: .02em;
        }

        /* ── Card hover lift ── */
        .card-lift { transition: transform .2s, box-shadow .2s; }
        .card-lift:hover { transform: translateY(-2px); box-shadow: 0 8px 24px -4px rgba(0,0,0,.12); }

        /* ── Animación de entrada ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp .35s ease both; }

        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="h-full bg-slate-50 dark:bg-[#0f1623] text-gray-900 dark:text-slate-100 font-sans antialiased"
      x-data="{ sidebarOpen: false, mobileMenuOpen: false }">

    <!-- Mobile overlay -->
    <div x-show="sidebarOpen"
         x-cloak
         x-transition:enter="transition-opacity ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false"
         class="fixed inset-0 bg-black/60 backdrop-blur-sm z-20 lg:hidden"></div>

    <div class="flex h-full min-h-screen">

        <!-- ═══════════════════ SIDEBAR ═══════════════════ -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
               class="fixed inset-y-0 left-0 z-30 w-64 flex flex-col
                      transform transition-transform duration-250 ease-out
                      lg:relative lg:translate-x-0 lg:flex lg:flex-shrink-0"
               style="background: linear-gradient(160deg, #1a3a08 0%, #2d6400 40%, #39A900 100%);">

            <!-- Logo / Brand -->
            <div class="flex items-center gap-3 px-5 py-5">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-lg flex-shrink-0">
                    <span class="text-sena-600 font-black text-xs tracking-tight">SENA</span>
                </div>
                <div class="leading-tight">
                    <p class="text-white font-bold text-sm">Bienestar</p>
                    <p class="text-white/60 text-xs font-medium">al Aprendiz</p>
                </div>
            </div>

            <!-- Divisor -->
            <div class="mx-4 h-px bg-white/10 mb-2"></div>

            <!-- Nav links -->
            <nav class="flex-1 px-3 py-2 space-y-0.5 overflow-y-auto">

                <!-- Sección principal -->
                <p class="px-3 pt-1 pb-2 text-[10px] font-semibold text-white/40 uppercase tracking-widest">
                    Principal
                </p>

                <a href="{{ route('dashboard') }}"
                   class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
                          {{ request()->routeIs('dashboard') ? 'nav-active' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                    <span class="flex items-center justify-center w-8 h-8 rounded-lg
                                 {{ request()->routeIs('dashboard') ? 'bg-white/20' : 'bg-white/5' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 5a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H5a1 1 0 01-1-1V5zm10 0a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zm10-2a1 1 0 011-1h4a1 1 0 011 1v6a1 1 0 01-1 1h-4a1 1 0 01-1-1v-6z"/>
                        </svg>
                    </span>
                    <span>Dashboard</span>
                </a>

                <!-- Sección solicitudes -->
                <p class="px-3 pt-3 pb-2 text-[10px] font-semibold text-white/40 uppercase tracking-widest">
                    Gestión
                </p>

                <a href="{{ route('solicitudes.create') }}"
                   class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
                          {{ request()->routeIs('solicitudes.create') ? 'nav-active' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                    <span class="flex items-center justify-center w-8 h-8 rounded-lg
                                 {{ request()->routeIs('solicitudes.create') ? 'bg-white/20' : 'bg-white/5' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </span>
                    <span>Nueva Solicitud</span>
                </a>

                <a href="{{ route('solicitudes.index') }}"
                   class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
                          {{ request()->routeIs('solicitudes.index', 'solicitudes.show', 'solicitudes.edit') ? 'nav-active' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                    <span class="flex items-center justify-center w-8 h-8 rounded-lg
                                 {{ request()->routeIs('solicitudes.index', 'solicitudes.show', 'solicitudes.edit') ? 'bg-white/20' : 'bg-white/5' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </span>
                    <span>Solicitudes</span>
                </a>

                <a href="{{ route('solicitudes.historial') }}"
                   class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
                          {{ request()->routeIs('solicitudes.historial') ? 'nav-active' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                    <span class="flex items-center justify-center w-8 h-8 rounded-lg
                                 {{ request()->routeIs('solicitudes.historial') ? 'bg-white/20' : 'bg-white/5' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </span>
                    <span>Historial</span>
                </a>

                <!-- Sección reportes -->
                <p class="px-3 pt-3 pb-2 text-[10px] font-semibold text-white/40 uppercase tracking-widest">
                    Reportes
                </p>

                <a href="{{ route('solicitudes.excel') }}"
                   class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
                          text-white/70 hover:bg-white/10 hover:text-white">
                    <span class="flex items-center justify-center w-8 h-8 rounded-lg bg-white/5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                    </span>
                    <span>Exportar Excel</span>
                </a>

            </nav>

            <!-- User info + logout -->
            <div class="mx-4 h-px bg-white/10 mt-2"></div>
            <div class="px-3 py-4">
                <div class="flex items-center gap-3 px-2 py-2 rounded-xl hover:bg-white/10 transition-colors group">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0
                                bg-gradient-to-br from-white/30 to-white/10 text-white font-bold text-sm shadow-inner">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-white text-sm font-semibold truncate leading-tight">{{ auth()->user()->name }}</p>
                        <p class="text-white/50 text-xs truncate">{{ auth()->user()->email }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="flex-shrink-0">
                        @csrf
                        <button type="submit" title="Cerrar sesión"
                                class="w-7 h-7 rounded-lg flex items-center justify-center
                                       text-white/40 hover:text-white hover:bg-white/20 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- ═══════════════════ MAIN CONTENT ═══════════════════ -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

            <!-- Top bar -->
            <header class="sticky top-0 z-10 flex-shrink-0
                           bg-white/80 dark:bg-[#0f1623]/90
                           backdrop-blur-md
                           border-b border-gray-200/60 dark:border-white/5
                           shadow-[0_1px_0_0_rgba(0,0,0,.05)]">
                <div class="flex items-center gap-4 px-5 py-3.5">

                    <!-- Hamburger (mobile) -->
                    <button @click="sidebarOpen = !sidebarOpen"
                            class="lg:hidden p-1.5 rounded-lg text-gray-500 hover:bg-gray-100
                                   dark:hover:bg-white/10 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <!-- Breadcrumb / Page title -->
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-gray-400 dark:text-gray-500 hidden sm:block">SENA</span>
                        <span class="text-xs text-gray-300 dark:text-gray-600 hidden sm:block">/</span>
                        <h1 class="text-sm font-semibold text-gray-800 dark:text-slate-100 truncate">
                            @yield('page-title', 'Bienestar al Aprendiz')
                        </h1>
                    </div>

                    <div class="flex items-center gap-2 ml-auto">
                        <!-- Fecha -->
                        <span class="hidden md:flex items-center gap-1.5 text-xs text-gray-400 dark:text-gray-500
                                     bg-gray-50 dark:bg-white/5 px-3 py-1.5 rounded-full">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ now()->locale('es')->isoFormat('D MMM YYYY') }}
                        </span>

                        <!-- Dark mode toggle -->
                        <button onclick="toggleDarkMode()" title="Cambiar tema"
                                class="w-8 h-8 flex items-center justify-center rounded-xl
                                       bg-gray-100 dark:bg-white/5
                                       text-gray-500 dark:text-gray-400
                                       hover:bg-gray-200 dark:hover:bg-white/10 transition-colors">
                            <!-- Sol (modo oscuro activo) -->
                            <svg class="w-4 h-4 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M17.657 17.657l-.707-.707M6.343 6.343l-.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/>
                            </svg>
                            <!-- Luna (modo claro activo) -->
                            <svg class="w-4 h-4 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </header>

            <!-- ── Alertas ── -->
            @if(session('success'))
                <div x-data="{ show: true }"
                     x-show="show"
                     x-init="setTimeout(() => show = false, 5000)"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="mx-5 mt-4 flex items-center gap-3
                            bg-emerald-50 dark:bg-emerald-900/20
                            border border-emerald-200 dark:border-emerald-800/50
                            text-emerald-800 dark:text-emerald-300
                            rounded-xl px-4 py-3 shadow-card">
                    <div class="flex-shrink-0 w-7 h-7 bg-emerald-100 dark:bg-emerald-800/40 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="text-sm font-medium flex-1">{{ session('success') }}</span>
                    <button @click="show = false"
                            class="text-emerald-500 hover:text-emerald-700 dark:hover:text-emerald-200 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div x-data="{ show: true }"
                     x-show="show"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="mx-5 mt-4 flex items-center gap-3
                            bg-red-50 dark:bg-red-900/20
                            border border-red-200 dark:border-red-800/50
                            text-red-800 dark:text-red-300
                            rounded-xl px-4 py-3 shadow-card">
                    <div class="flex-shrink-0 w-7 h-7 bg-red-100 dark:bg-red-800/40 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                        </svg>
                    </div>
                    <span class="text-sm font-medium flex-1">{{ session('error') }}</span>
                    <button @click="show = false"
                            class="text-red-500 hover:text-red-700 dark:hover:text-red-200 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif

            @if ($errors->any() && !session('success'))
                <div class="mx-5 mt-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/50
                             rounded-xl px-4 py-3 shadow-card">
                    <p class="text-sm font-semibold text-red-700 dark:text-red-400 mb-1">Por favor corrija los siguientes errores:</p>
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm text-red-600 dark:text-red-300">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Page content -->
            <main class="flex-1 overflow-y-auto p-5 lg:p-7 fade-up">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="flex-shrink-0 border-t border-gray-200/60 dark:border-white/5
                           bg-white/40 dark:bg-transparent
                           text-center text-xs text-gray-400 dark:text-gray-600 py-3">
                SENA · Servicio Nacional de Aprendizaje · Bienestar al Aprendiz · {{ now()->year }}
            </footer>
        </div>
    </div>

    <script>
        function toggleDarkMode() {
            const html = document.documentElement;
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                html.classList.add('dark');
                localStorage.theme = 'dark';
            }
        }
    </script>

    @stack('scripts')
</body>
</html>
