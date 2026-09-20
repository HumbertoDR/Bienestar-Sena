<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Iniciar Sesión — Bienestar al Aprendiz SENA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        sena: { green: '#39A900', dark: '#2d8200' }
                    }
                }
            }
        }
        if (localStorage.theme === 'dark' ||
            (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>
<body class="h-full bg-gradient-to-br from-sena-green via-green-700 to-green-900
             dark:from-gray-900 dark:via-gray-800 dark:to-gray-900
             flex items-center justify-center p-4">

    <div class="w-full max-w-md">

        <!-- Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">

            <!-- Header verde -->
            <div class="bg-sena-green px-8 py-8 text-center">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-3 shadow-lg">
                    <span class="text-sena-green font-black text-xl">SENA</span>
                </div>
                <h1 class="text-white text-xl font-bold">Bienestar al Aprendiz</h1>
                <p class="text-green-100 text-sm mt-1">Servicio Nacional de Aprendizaje</p>
            </div>

            <!-- Form -->
            <div class="px-8 py-8">
                <h2 class="text-gray-800 dark:text-gray-100 text-lg font-semibold mb-6 text-center">
                    Iniciar Sesión
                </h2>

                @if($errors->any())
                    <div class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-700
                                rounded-lg px-4 py-3 mb-5">
                        <p class="text-red-700 dark:text-red-300 text-sm">
                            {{ $errors->first() }}
                        </p>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email"
                               class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                            Correo electrónico
                        </label>
                        <input type="email"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autofocus
                               placeholder="usuario@sena.edu.co"
                               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                                      placeholder-gray-400 dark:placeholder-gray-500
                                      focus:outline-none focus:ring-2 focus:ring-sena-green focus:border-transparent
                                      transition-colors text-sm"/>
                    </div>

                    <div>
                        <label for="password"
                               class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                            Contraseña
                        </label>
                        <input type="password"
                               id="password"
                               name="password"
                               required
                               placeholder="••••••••"
                               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                                      placeholder-gray-400 dark:placeholder-gray-500
                                      focus:outline-none focus:ring-2 focus:ring-sena-green focus:border-transparent
                                      transition-colors text-sm"/>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember"
                               class="w-4 h-4 text-sena-green border-gray-300 rounded focus:ring-sena-green"/>
                        <label for="remember" class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                            Recordar sesión
                        </label>
                    </div>

                    <button type="submit"
                            class="w-full bg-sena-green hover:bg-sena-dark text-white font-semibold
                                   py-2.5 rounded-lg transition-colors duration-150 text-sm shadow-md
                                   hover:shadow-lg active:scale-[0.98]">
                        Ingresar al sistema
                    </button>
                </form>

                <p class="text-center text-xs text-gray-400 dark:text-gray-500 mt-6">
                    Acceso exclusivo para personal autorizado de Bienestar
                </p>
            </div>
        </div>

        <!-- Dark mode toggle -->
        <div class="text-center mt-4">
            <button onclick="toggleDark()"
                    class="text-white/70 hover:text-white text-xs underline transition-colors">
                Cambiar a modo oscuro/claro
            </button>
        </div>
    </div>

    <script>
        function toggleDark() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            }
        }
    </script>
</body>
</html>
