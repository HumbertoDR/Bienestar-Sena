<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Iniciar Sesión — Bienestar al Aprendiz SENA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'ui-sans-serif', 'system-ui'] },
                    colors: { sena: { 500: '#39A900', 600: '#2d8200', 700: '#236500' } },
                    keyframes: {
                        fadeUp: { from: { opacity: '0', transform: 'translateY(16px)' }, to: { opacity: '1', transform: 'translateY(0)' } },
                        shimmer: { '0%,100%': { opacity: '.6' }, '50%': { opacity: '1' } },
                    },
                    animation: {
                        'fade-up': 'fadeUp .5s ease both',
                        'fade-up-d1': 'fadeUp .5s .1s ease both',
                        'fade-up-d2': 'fadeUp .5s .2s ease both',
                        'shimmer': 'shimmer 3s ease-in-out infinite',
                    }
                }
            }
        }
        if (localStorage.theme === 'dark' ||
            (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
    <style>
        * { font-family: 'Inter', sans-serif; }
        .input-login {
            width: 100%;
            padding: .625rem 1rem .625rem 2.75rem;
            font-size: .875rem;
            border-radius: .75rem;
            border: 1.5px solid #e5e7eb;
            background: #f9fafb;
            color: #111827;
            outline: none;
            transition: border-color .15s, box-shadow .15s, background .15s;
        }
        .input-login:focus { border-color: #39A900; box-shadow: 0 0 0 3px rgba(57,169,0,.15); background: #fff; }
        .dark .input-login { background: #1e2533; border-color: #2d3748; color: #f1f5f9; }
        .dark .input-login:focus { border-color: #39A900; box-shadow: 0 0 0 3px rgba(57,169,0,.2); background: #252e3f; }
        .dark .input-login::placeholder { color: #4b5563; }

        /* Left panel decorative bubbles */
        .bubble {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,.08);
            animation: float 8s ease-in-out infinite;
        }
        @keyframes float {
            0%,100% { transform: translateY(0) scale(1); }
            50%      { transform: translateY(-20px) scale(1.04); }
        }
    </style>
</head>
<body class="h-full bg-gray-50 dark:bg-[#0f1623] font-sans antialiased">

<div class="min-h-screen flex">

    {{-- ── Lado izquierdo (decorativo) ── --}}
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden
                items-center justify-center"
         style="background: linear-gradient(145deg, #103a00 0%, #1e6000 45%, #39A900 100%);">

        <!-- Burbujas de fondo -->
        <div class="bubble w-64 h-64 top-[-60px] left-[-60px]" style="animation-delay:0s"></div>
        <div class="bubble w-48 h-48 bottom-20 left-10"         style="animation-delay:2s"></div>
        <div class="bubble w-32 h-32 top-1/3 right-10"         style="animation-delay:4s"></div>
        <div class="bubble w-80 h-80 bottom-[-80px] right-[-60px]" style="animation-delay:1s"></div>

        <!-- Contenido central -->
        <div class="relative z-10 text-center px-12 max-w-md">
            <!-- Logo grande -->
            <div class="w-24 h-24 bg-white rounded-3xl flex items-center justify-center mx-auto mb-8
                        shadow-[0_8px_32px_rgba(0,0,0,.25)]">
                <span class="text-sena-500 font-black text-3xl tracking-tight">SENA</span>
            </div>

            <h1 class="text-white text-3xl font-bold leading-tight mb-3">
                Bienestar<br>al Aprendiz
            </h1>
            <p class="text-white/60 text-base font-light leading-relaxed">
                Sistema de gestión y seguimiento de casos de bienestar estudiantil del Servicio Nacional de Aprendizaje.
            </p>

            <!-- Stats decorativos -->
            <div class="mt-10 grid grid-cols-3 gap-3">
                @foreach([['🎓','Aprendices','Atendidos'],['🤖','IA','Integrada'],['📊','Reportes','en Tiempo Real']] as $stat)
                <div class="bg-white/10 backdrop-blur rounded-2xl p-4">
                    <div class="text-2xl mb-1">{{ $stat[0] }}</div>
                    <p class="text-white font-semibold text-sm">{{ $stat[1] }}</p>
                    <p class="text-white/50 text-xs">{{ $stat[2] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ── Lado derecho (formulario) ── --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 lg:p-12">
        <div class="w-full max-w-md animate-fade-up">

            <!-- Header mobile (solo visible en móvil) -->
            <div class="lg:hidden text-center mb-8">
                <div class="w-16 h-16 bg-sena-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <span class="text-white font-black text-xl">SENA</span>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Bienestar al Aprendiz</h1>
            </div>

            <!-- Card del formulario -->
            <div class="bg-white dark:bg-[#161e2e] rounded-3xl shadow-[0_8px_40px_rgba(0,0,0,.10)]
                        dark:shadow-[0_8px_40px_rgba(0,0,0,.4)] p-8">

                <div class="mb-7 animate-fade-up-d1" style="opacity:0">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Bienvenido</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Ingresa tus credenciales para continuar
                    </p>
                </div>

                @if($errors->any())
                    <div class="flex items-start gap-3 bg-red-50 dark:bg-red-900/20
                                border border-red-200 dark:border-red-800/50
                                rounded-xl px-4 py-3 mb-6">
                        <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                        </svg>
                        <p class="text-sm text-red-700 dark:text-red-300">{{ $errors->first() }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5 animate-fade-up-d2" style="opacity:0">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                            Correo electrónico
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                </svg>
                            </div>
                            <input type="email" id="email" name="email"
                                   value="{{ old('email') }}"
                                   required autofocus
                                   placeholder="usuario@sena.edu.co"
                                   class="input-login"/>
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                            Contraseña
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input type="password" id="password" name="password"
                                   required
                                   placeholder="••••••••"
                                   class="input-login"/>
                        </div>
                    </div>

                    <!-- Recuérdame -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" id="remember" name="remember"
                                   class="w-4 h-4 rounded border-gray-300 text-sena-500
                                          focus:ring-sena-500 focus:ring-offset-0 cursor-pointer"/>
                            <span class="text-sm text-gray-600 dark:text-gray-400">Recordar sesión</span>
                        </label>
                    </div>

                    <!-- Botón submit -->
                    <button type="submit"
                            class="w-full flex items-center justify-center gap-2
                                   bg-sena-500 hover:bg-sena-600 active:bg-sena-700
                                   text-white font-semibold
                                   py-3 rounded-xl
                                   transition-all duration-150
                                   shadow-[0_4px_14px_rgba(57,169,0,.4)]
                                   hover:shadow-[0_6px_20px_rgba(57,169,0,.5)]
                                   active:scale-[0.98] text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Ingresar al sistema
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <div class="mt-6 flex items-center justify-between">
                <p class="text-xs text-gray-400 dark:text-gray-600">
                    Acceso exclusivo para personal autorizado
                </p>
                <button onclick="toggleDark()"
                        class="text-xs text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-400
                               transition-colors flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M17.657 17.657l-.707-.707M6.343 6.343l-.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/>
                    </svg>
                    <svg class="w-3.5 h-3.5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                    Cambiar tema
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Forzar animaciones (las clases de opacity:0 inline se sobreescriben)
    document.querySelectorAll('[style*="opacity:0"]').forEach(el => {
        el.style.opacity = '';
    });
    function toggleDark() {
        const h = document.documentElement;
        if (h.classList.contains('dark')) {
            h.classList.remove('dark');
            localStorage.theme = 'light';
        } else {
            h.classList.add('dark');
            localStorage.theme = 'dark';
        }
    }
</script>
</body>
</html>
