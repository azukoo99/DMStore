<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'DiamondStore - Top Up Mobile Legends' }}</title>
        <meta name="description" content="{{ $description ?? 'DiamondStore - Top Up Mobile Legends dengan harga terbaik dan proses cepat.' }}">

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
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@400;600;800&display=swap" rel="stylesheet">

        <!-- Skrip -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-800 dark:text-slate-100 bg-slate-50 dark:bg-slate-950 min-h-screen relative overflow-x-hidden transition-colors duration-300">
        <!-- Elemen cahaya latar belakang (hanya terlihat di mode gelap) -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[120px] pointer-events-none animate-pulse duration-[6000ms] hidden dark:block"></div>
        <div class="absolute top-[600px] left-0 w-[400px] h-[400px] bg-purple-600/10 rounded-full blur-[100px] pointer-events-none animate-pulse duration-[8000ms] hidden dark:block"></div>
        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-indigo-600/5 rounded-full blur-[150px] pointer-events-none hidden dark:block"></div>

        <div class="min-h-screen relative z-10">
            @include('layouts.navigation')

            <!-- Header Halaman -->
            @isset($header)
                <header class="bg-white/50 dark:bg-slate-900/50 backdrop-blur-md border-b border-slate-200 dark:border-white/5 shadow-sm">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Konten Halaman -->
            <main>
                {{ $slot }}
            </main>

            @include('layouts.footer')
        </div>
    </body>
</html>
