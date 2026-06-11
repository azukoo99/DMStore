<!-- FOOTER -->
<footer class="mt-16 border-t border-slate-200 dark:border-white/5 bg-white dark:bg-slate-950 py-12 relative z-10 text-slate-500 dark:text-slate-400 text-sm transition-colors duration-300">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="space-y-4">
            <div class="flex items-center gap-2.5">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-7 h-7 object-contain rounded-md">
                <span class="font-outfit text-base font-extrabold text-slate-900 dark:text-white">DiamondStore</span>
            </div>
            <p class="leading-relaxed text-xs">
                Platform top up Mobile Legends terpercaya sejak 2023. Proses instan 24 jam nonstop dengan harga terbaik.
            </p>
            <div class="flex items-center gap-3 pt-2">
                <a href="#" class="text-xs font-semibold px-3 py-1.5 rounded bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-white/5 text-slate-700 dark:text-slate-350 hover:text-blue-600 dark:hover:text-white transition-colors">📘 Facebook</a>
                <a href="#" class="text-xs font-semibold px-3 py-1.5 rounded bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-white/5 text-slate-700 dark:text-slate-350 hover:text-blue-600 dark:hover:text-white transition-colors">📸 Instagram</a>
                <a href="#" class="text-xs font-semibold px-3 py-1.5 rounded bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-white/5 text-slate-700 dark:text-slate-350 hover:text-blue-600 dark:hover:text-white transition-colors">🐦 Twitter</a>
            </div>
        </div>
        
        <div class="space-y-4">
            <h4 class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-wider">Tautan Cepat</h4>
            <ul class="space-y-2 text-xs">
                <li><a href="{{ url('/') }}#beranda" class="hover:text-blue-600 dark:hover:text-white transition-colors">🏠 Beranda</a></li>
                <li><a href="{{ url('/') }}#promo" class="hover:text-blue-600 dark:hover:text-white transition-colors">🎁 Promo</a></li>
                <li><a href="{{ url('/') }}#topup" class="hover:text-blue-600 dark:hover:text-white transition-colors">💎 Top Up</a></li>
                @auth
                    <li><a href="{{ route('riwayat') }}" class="hover:text-blue-600 dark:hover:text-white transition-colors">📋 Riwayat</a></li>
                @endauth
            </ul>
        </div>

        <div class="space-y-4">
            <h4 class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-wider">Hubungi Kami</h4>
            <address class="space-y-2 text-xs not-italic leading-relaxed">
                <p>📍 Jl. Gamer No. 88, Jakarta Selatan</p>
                <p>📧 support@diamondstore.id</p>
                <p>📱 +62 812-3456-7890</p>
                <p class="text-slate-400 dark:text-slate-500 pt-1">🕐 Jam Layanan CS: 08.00 - 22.00 WIB</p>
            </address>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-10 pt-6 border-t border-slate-200 dark:border-white/5 text-center text-xs text-slate-400 dark:text-slate-500">
        <p>&copy; 2026 DiamondStore. Semua hak dilindungi. Bukan afiliasi resmi Moonton.</p>
    </div>
</footer>
