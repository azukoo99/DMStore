<nav class="sticky top-0 z-50 w-full bg-white/80 dark:bg-slate-950/80 backdrop-blur-md border-b border-slate-200 dark:border-white/5 shadow-sm dark:shadow-lg transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center gap-3">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-9 h-9 object-contain rounded-lg">
                <div class="flex flex-col leading-tight">
                    <span class="font-outfit text-lg font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-blue-400 dark:to-indigo-400">DiamondStore</span>
                    <span class="text-[9px] text-slate-500 dark:text-slate-400 font-medium tracking-wide">Top Up Mobile Legends</span>
                </div>
            </a>
        </div>

        <!-- Grup Aksi Header -->
        <div class="flex items-center gap-4">
            <!-- Tombol Toggle Tema -->
            <button id="theme-toggle" class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-white/10 text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-white transition-colors duration-200 focus:outline-none" aria-label="Toggle theme">
                <!-- Ikon Bulan (mode gelap) -->
                <svg id="theme-toggle-dark-icon" class="w-4 h-4 hidden" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
                <!-- Ikon Matahari (mode terang) -->
                <svg id="theme-toggle-light-icon" class="w-4 h-4 hidden" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.46 5.05l-.707-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                </svg>
            </button>

            <!-- Link Navigasi (Desktop) -->
            <nav class="navbar-menu hidden sm:flex items-center gap-6" id="navbar-menu">
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="nav-link text-sm font-semibold {{ request()->routeIs('admin.dashboard') ? 'text-blue-600 dark:text-blue-400' : 'text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-white' }} transition-colors">📊 Dashboard Admin</a>
                    @else
                        <a href="{{ url('/') }}#beranda" class="nav-link text-sm font-semibold {{ request()->is('/') ? 'text-blue-600 dark:text-blue-400' : 'text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-white' }} transition-colors">🏠 Beranda</a>
                        <a href="{{ url('/') }}#promo" class="nav-link text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-white transition-colors">🎁 Promo</a>
                        <a href="{{ url('/') }}#topup" class="nav-link text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-white transition-colors">💎 Top Up</a>
                        <a href="{{ route('riwayat') }}" class="nav-link text-sm font-semibold {{ request()->routeIs('riwayat') ? 'text-blue-600 dark:text-blue-400' : 'text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-white' }} transition-colors">📋 Riwayat</a>
                    @endif
                @else
                    <a href="{{ url('/') }}#beranda" class="nav-link text-sm font-semibold {{ request()->is('/') ? 'text-blue-600 dark:text-blue-400' : 'text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-white' }} transition-colors">🏠 Beranda</a>
                    <a href="{{ url('/') }}#promo" class="nav-link text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-white transition-colors">🎁 Promo</a>
                    <a href="{{ url('/') }}#topup" class="nav-link text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-white transition-colors">💎 Top Up</a>
                @endauth

                <!-- Link Khusus HP di dalam kontainer navigasi -->
                @auth
                    <a href="{{ route('profile.edit') }}" class="sm:hidden block text-sm font-bold {{ request()->routeIs('profile.edit') ? 'text-blue-600 dark:text-blue-400' : 'text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-white' }} mt-2">👤 Profil</a>
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="sm:hidden block text-sm font-bold {{ request()->routeIs('admin.dashboard') ? 'text-blue-600 dark:text-blue-400' : 'text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-white' }} mt-2">📊 Dashboard Admin</a>
                    @endif
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();" class="sm:hidden block text-center px-4 py-2 mt-1 rounded-xl font-bold bg-rose-600/10 hover:bg-rose-600/20 text-rose-500 border border-rose-500/20">Keluar</a>
                    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}" class="sm:hidden block text-center px-4 py-2 mt-2 rounded-xl font-bold bg-blue-600 hover:bg-blue-500 text-white transition-colors">Masuk</a>
                @endauth
            </nav>

            <!-- Bagian Masuk / Akun khusus Desktop -->
            <div class="navbar-action hidden sm:block">
                @auth
                    <div class="flex items-center gap-3">
                        <a href="{{ route('profile.edit') }}" class="px-4 py-2 text-sm font-bold rounded-xl {{ request()->routeIs('profile.edit') ? 'bg-blue-600/10 text-blue-600 dark:text-blue-400 border border-blue-500/20' : 'bg-slate-100 dark:bg-slate-900 hover:bg-slate-200 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-white/10' }} transition-colors">👤 Profil</a>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-desktop').submit();" class="px-4 py-2 text-sm font-bold rounded-xl bg-rose-600/10 hover:bg-rose-600/20 text-rose-500 border border-rose-500/20 transition-all duration-200">Keluar</a>
                        <form id="logout-form-desktop" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-2 text-sm font-bold rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white shadow-lg shadow-blue-500/20 hover:scale-105 active:scale-[0.98] transition-all duration-200">Masuk</a>
                @endauth
            </div>

            <!-- Tombol Hamburger untuk HP -->
            <button class="hamburger sm:hidden flex flex-col justify-between w-6 h-4 bg-transparent border-none cursor-pointer focus:outline-none" id="hamburger" aria-label="Buka menu">
                <span class="block w-full h-[2px] bg-slate-600 dark:bg-slate-300 rounded transition-all duration-300"></span>
                <span class="block w-full h-[2px] bg-slate-600 dark:bg-slate-300 rounded transition-all duration-300"></span>
                <span class="block w-full h-[2px] bg-slate-600 dark:bg-slate-300 rounded transition-all duration-300"></span>
            </button>
        </div>
    </div>
</nav>
