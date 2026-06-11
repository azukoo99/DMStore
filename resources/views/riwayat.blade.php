<x-app-layout>
    <x-slot name="header">
        <h2 class="font-outfit font-extrabold text-xl text-slate-900 dark:text-white leading-tight">
            {{ __('Riwayat Pesanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-2xl bg-green-50 dark:bg-green-950/30 dark:text-green-400 border border-green-200 dark:border-green-500/20" role="alert">
                    <span class="font-bold">Sukses!</span> {{ session('status') }}
                </div>
            @endif

            <!-- Pesanan Card -->
            <div class="bg-white dark:bg-slate-900/50 backdrop-blur-xl border border-slate-200 dark:border-white/5 rounded-3xl p-6 sm:p-8 shadow-sm dark:shadow-xl">
                <h3 class="font-outfit font-bold text-lg text-slate-900 dark:text-white mb-4">Daftar Pesanan Anda</h3>
                
                @if($pesanans->isEmpty())
                    <div class="text-center py-12 space-y-3">
                        <span class="text-4xl">📭</span>
                        <p class="text-slate-500 dark:text-slate-400 text-sm">Belum ada riwayat pesanan top up.</p>
                        <a href="{{ url('/') }}#topup" class="inline-block px-6 py-2.5 text-xs font-bold bg-blue-600 hover:bg-blue-500 text-white rounded-xl shadow-lg shadow-blue-500/10 transition-colors">Top Up Sekarang</a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-slate-200 dark:border-white/5 text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                                    <th class="py-3.5 px-4">Tanggal</th>
                                    <th class="py-3.5 px-4">ID Game</th>
                                    <th class="py-3.5 px-4">Paket</th>
                                    <th class="py-3.5 px-4">Harga</th>
                                    <th class="py-3.5 px-4">Pembayaran</th>
                                    <th class="py-3.5 px-4 text-center">Status</th>
                                    <th class="py-3.5 px-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-white/5 text-sm">
                                @foreach($pesanans as $tx)
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-white/5 transition-colors">
                                        <td class="py-4 px-4 text-xs font-medium text-slate-500 dark:text-slate-400">
                                            {{ $tx->created_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
                                        </td>
                                        <td class="py-4 px-4 font-semibold text-slate-900 dark:text-white">
                                            {{ $tx->game_user_id }} <span class="text-xs text-slate-400 font-normal">({{ $tx->zone_id }})</span>
                                        </td>
                                        <td class="py-4 px-4 font-medium text-slate-800 dark:text-slate-200">
                                            {{ $tx->paket }}
                                        </td>
                                        <td class="py-4 px-4 font-bold text-blue-600 dark:text-blue-400">
                                            Rp {{ number_format($tx->harga, 0, ',', '.') }}
                                        </td>
                                        <td class="py-4 px-4 text-xs font-bold uppercase text-slate-600 dark:text-slate-350">
                                            {{ $tx->pembayaran }}
                                        </td>
                                        <td class="py-4 px-4 text-center">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-600/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400">
                                                {{ $tx->status }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4 text-right">
                                            <a href="{{ route('riwayat.show', $tx->id) }}" class="inline-flex items-center px-3 py-1.5 rounded-xl font-bold bg-blue-600 hover:bg-blue-500 text-white text-xs shadow-md shadow-blue-500/10 transition-colors">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
