<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'DiamondStore') }}</title>

        <!-- Pengecekan tema secara inline untuk mencegah kedipan layar -->
        <script>
            const theme = document.cookie.split('; ').find(row => row.startsWith('color-theme='))?.split('=')[1];
            if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>

        <!-- Font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@400;600;800&display=swap" rel="stylesheet" />

        <!-- Skrip -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-800 dark:text-slate-100 bg-slate-50 dark:bg-slate-950 min-h-screen flex items-center justify-center relative overflow-hidden p-4 sm:p-6 transition-colors duration-300">
        <!-- Bola cahaya ambient menggunakan Tailwind (hanya terlihat di mode gelap) -->
        <div class="absolute top-0 right-0 -mt-24 -mr-24 w-96 h-96 bg-blue-600/10 rounded-full blur-[120px] pointer-events-none animate-pulse duration-3000 hidden dark:block"></div>
        <div class="absolute bottom-0 left-0 -mb-32 -ml-32 w-[500px] h-[500px] bg-purple-600/10 rounded-full blur-[140px] pointer-events-none animate-pulse duration-[6000ms] hidden dark:block"></div>
        
        <div class="w-full max-w-md z-10 animate-fade-in-up">
            <!-- Kontainer Kartu Glassmorphic -->
            <div class="bg-white/85 dark:bg-slate-900/50 backdrop-blur-2xl border border-slate-200/80 dark:border-white/10 shadow-2xl rounded-3xl p-8 sm:p-10 transition-colors duration-300">
                <div class="flex flex-col items-center mb-8">
                    <a href="/" class="group flex items-center justify-center w-16 h-16 bg-gradient-to-tr from-blue-600/10 to-purple-600/10 dark:from-blue-600/20 dark:to-purple-600/20 border border-slate-200 dark:border-white/10 rounded-2xl shadow-lg transition-all duration-300 hover:scale-105 hover:rotate-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10 h-10 object-contain">
                    </a>
                </div>

                {{ $slot }}
            </div>
            
            <!-- Link Kembali Melayang -->
            <div class="text-center mt-6">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-white transition-colors duration-200 group">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
        </div>
    </body>
</html>
