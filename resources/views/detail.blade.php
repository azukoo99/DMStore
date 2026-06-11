<x-app-layout>
    <x-slot name="header">
        <h2 class="font-outfit font-extrabold text-xl text-slate-900 dark:text-white leading-tight">
            {{ __('Detail Pesanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto px-4 sm:px-6 space-y-6">
            
            <!-- Invoice Card -->
            <div class="bg-white dark:bg-slate-900/50 backdrop-blur-xl border border-slate-200 dark:border-white/5 rounded-3xl shadow-lg dark:shadow-2xl overflow-hidden">
                <!-- Receipt Header -->
                <div class="bg-blue-600 p-6 text-center text-white relative">
                    <!-- Brand Logo / Name -->
                    <div class="flex justify-center items-center gap-2 mb-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-auto">
                        <span class="font-outfit font-extrabold text-lg tracking-wider">DIAMONDSTORE</span>
                    </div>
                    <h3 class="font-outfit font-bold text-base uppercase tracking-wider opacity-90">Struk Pembelian</h3>
                    <p class="text-[10px] opacity-75 mt-0.5">ID Pesanan: #PS-{{ str_pad($pesanan->id, 6, '0', STR_PAD_LEFT) }}</p>

                    <!-- Decorative Receipt Cutouts at bottom of header -->
                    <div class="absolute bottom-0 left-0 right-0 h-1 flex justify-between px-2">
                        @for ($i = 0; $i < 20; $i++)
                            <span class="w-2 h-2 bg-slate-50 dark:bg-slate-950 rounded-full -mb-1"></span>
                        @endfor
                    </div>
                </div>

                <!-- Receipt Body -->
                <div class="p-6 sm:p-8 space-y-6">
                    
                    <!-- Status Badge Block -->
                    <div class="flex flex-col items-center justify-center border-b border-dashed border-slate-200 dark:border-white/5 pb-5">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Status</span>
                        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold bg-emerald-600/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400">
                            🟢 {{ $pesanan->status }}
                        </span>
                    </div>

                    <!-- Details Table -->
                    <div class="space-y-4 text-xs">
                        <!-- Waktu Pesanan -->
                        <div class="flex justify-between items-center">
                            <span class="text-slate-500 dark:text-slate-400">Waktu Pesanan</span>
                            <span class="font-semibold text-slate-800 dark:text-slate-200">
                                {{ $pesanan->created_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
                            </span>
                        </div>

                        <!-- User ID Game -->
                        <div class="flex justify-between items-center">
                            <span class="text-slate-500 dark:text-slate-400">ID Game (Zone ID)</span>
                            <span class="font-bold text-slate-850 dark:text-slate-100 font-mono">
                                {{ $pesanan->game_user_id }} ({{ $pesanan->zone_id }})
                            </span>
                        </div>

                        <!-- Paket Diamond -->
                        <div class="flex justify-between items-center">
                            <span class="text-slate-500 dark:text-slate-400">Item Pembelian</span>
                            <span class="font-bold text-slate-900 dark:text-white">
                                💎 {{ $pesanan->paket }}
                            </span>
                        </div>

                        <!-- Metode Pembayaran -->
                        <div class="flex justify-between items-center">
                            <span class="text-slate-500 dark:text-slate-400">Metode Pembayaran</span>
                            <span class="font-bold uppercase text-slate-800 dark:text-slate-200">
                                {{ $pesanan->pembayaran }}
                            </span>
                        </div>

                        <!-- Email Penerima -->
                        @if($pesanan->email)
                            <div class="flex justify-between items-center">
                                <span class="text-slate-500 dark:text-slate-400">Email Penerima</span>
                                <span class="font-semibold text-slate-800 dark:text-slate-200">
                                    {{ $pesanan->email }}
                                </span>
                            </div>
                        @endif

                        <!-- Pembatas -->
                        <div class="border-b border-dashed border-slate-200 dark:border-white/5"></div>

                        <!-- Total Pembayaran -->
                        <div class="flex justify-between items-center pt-2">
                            <span class="text-slate-900 dark:text-white font-bold text-sm">Total Bayar</span>
                            <span class="font-extrabold text-blue-600 dark:text-blue-400 text-lg">
                                Rp {{ number_format($pesanan->harga, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <!-- Footer Note -->
                    <div class="text-center pt-4 border-t border-slate-100 dark:border-white/5">
                        <p class="text-[10px] text-slate-500 dark:text-slate-400 italic">Simpan struk ini sebagai bukti pembayaran yang sah.</p>
                        <p class="text-[10px] text-blue-500 font-bold mt-1">DiamondStore - Proses Instan, Harga Nyaman</p>
                    </div>

                </div>
            </div>

            <!-- Action Buttons -->
            <div>
                <a href="{{ route('riwayat') }}" class="block w-full py-3 text-center rounded-2xl font-bold bg-blue-600 hover:bg-blue-550 text-white text-xs shadow-lg shadow-blue-500/10 transition-all">
                    ← Kembali ke Riwayat
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
