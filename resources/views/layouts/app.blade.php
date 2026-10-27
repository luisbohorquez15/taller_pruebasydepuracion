<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediCitas - Gestión de Citas Médicas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 text-slate-800 font-sans min-h-screen flex flex-col justify-between">

    <!-- Header / Navbar -->
    <header class="bg-brand-600 shadow-md text-white">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4m-4 0V9a2 2 0 012-2h2a2 2 0 012 2v12"/>
                </svg>
                <span class="text-2xl font-bold tracking-wide">MediCitas</span>
            </div>
            <nav class="flex space-x-4">
                <a href="{{ route('citas.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium hover:bg-brand-700 transition">Ver Citas</a>
                <a href="{{ route('citas.create') }}" class="px-4 py-2 bg-white text-brand-600 rounded-lg text-sm font-semibold shadow hover:bg-brand-50 transition">Agendar Cita</a>
            </nav>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="max-w-7xl mx-auto w-full px-6 py-8 flex-grow">
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 rounded-r shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 py-6 mt-12 text-center text-sm text-slate-500">
        &copy; {{ date('Y') }} MediCitas. Sistema de Gestión Médica Unab.
    </footer>

</body>
</html>