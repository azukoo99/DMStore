<x-app-layout>
    <x-slot name="header">
        <h2 class="font-outfit font-extrabold text-xl text-slate-900 dark:text-white leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- Alert Session Status -->
            @if (session('status'))
                <div class="p-4 text-sm text-green-800 rounded-2xl bg-green-50 dark:bg-green-950/30 dark:text-green-400 border border-green-200 dark:border-green-500/20" role="alert">
                    <span class="font-bold">Sukses!</span> {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="p-4 text-sm text-rose-800 rounded-2xl bg-rose-50 dark:bg-rose-950/30 dark:text-rose-400 border border-rose-200 dark:border-rose-500/20" role="alert">
                    <span class="font-bold">Error!</span> {{ $errors->first() }}
                </div>
            @endif

            <!-- 1. STATS SECTION -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Transactions Today -->
                <div class="bg-white dark:bg-slate-900/40 backdrop-blur-md border border-slate-200 dark:border-white/5 rounded-3xl p-6 shadow-sm dark:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="block text-2xl font-extrabold text-slate-950 dark:text-white font-outfit">{{ $stats['pesanans_today'] }}</span>
                            <span class="block text-xs text-slate-500 dark:text-slate-400 mt-1 font-semibold uppercase tracking-wider">Pesanan Hari Ini</span>
                        </div>
                        <div class="w-12 h-12 bg-blue-600/10 rounded-2xl flex items-center justify-center text-blue-600 dark:text-blue-400">
                            <span class="text-xl">📊</span>
                        </div>
                    </div>
                </div>

                <!-- Revenue Today -->
                <div class="bg-white dark:bg-slate-900/40 backdrop-blur-md border border-slate-200 dark:border-white/5 rounded-3xl p-6 shadow-sm dark:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="block text-2xl font-extrabold text-emerald-600 dark:text-emerald-400 font-outfit">Rp {{ number_format($stats['revenue_today'], 0, ',', '.') }}</span>
                            <span class="block text-xs text-slate-500 dark:text-slate-400 mt-1 font-semibold uppercase tracking-wider">Pendapatan Hari Ini</span>
                        </div>
                        <div class="w-12 h-12 bg-emerald-600/10 rounded-2xl flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                            <span class="text-xl">💰</span>
                        </div>
                    </div>
                </div>

                <!-- Diamonds Sold Today -->
                <div class="bg-white dark:bg-slate-900/40 backdrop-blur-md border border-slate-200 dark:border-white/5 rounded-3xl p-6 shadow-sm dark:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="block text-2xl font-extrabold text-amber-500 dark:text-yellow-400 font-outfit">{{ number_format($stats['diamonds_today'], 0, ',', '.') }}</span>
                            <span class="block text-xs text-slate-500 dark:text-slate-400 mt-1 font-semibold uppercase tracking-wider">Diamond Terjual</span>
                        </div>
                        <div class="w-12 h-12 bg-amber-550/10 rounded-2xl flex items-center justify-center text-amber-500">
                            <span class="text-xl">💎</span>
                        </div>
                    </div>
                </div>
            </div>              <!-- 2. STOCKS & TRANSACTIONS SECTION -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Diamond Product Management -->
                <div class="lg:col-span-5">
                    
                    <!-- Card 1: Kelola Stok Produk -->
                    <div class="bg-white dark:bg-slate-900/40 backdrop-blur-md border border-slate-200 dark:border-white/5 rounded-3xl p-6 shadow-sm dark:shadow-xl space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div>
                                <h3 class="font-outfit font-bold text-lg text-slate-900 dark:text-white">Kelola Stok Produk</h3>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Perbarui persediaan diamond untuk setiap produk.</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="relative w-full sm:w-40">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-2.5 pointer-events-none text-slate-400 text-[10px]">🔍</span>
                                    <input type="text" id="search-product" placeholder="Cari..." class="w-full bg-slate-50/50 dark:bg-slate-950/40 border border-slate-200 dark:border-slate-800 rounded-xl pl-7 pr-3 py-1.5 text-xs text-slate-900 dark:text-white placeholder-slate-450 dark:placeholder-slate-500 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-200">
                                </div>
                                <button onclick="toggleAddProductModal(true)" class="px-3 py-1.5 rounded-xl font-bold bg-blue-600 hover:bg-blue-550 text-white text-xs shadow-md shadow-blue-500/10 transition-all flex items-center gap-1 whitespace-nowrap">
                                    Tambah
                                </button>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-slate-200 dark:border-white/5 text-xs font-bold text-slate-400 dark:text-slate-550 uppercase tracking-wider">
                                        <th class="py-3 px-2">Produk</th>
                                        <th class="py-3 px-2">Harga</th>
                                        <th class="py-3 px-2 text-center">Stok</th>
                                        <th class="py-3 px-2 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="products-table-body" class="divide-y divide-slate-100 dark:divide-white/5 text-sm">
                                    @foreach($products as $product)
                                        <tr class="hover:bg-slate-50/50 dark:hover:bg-white/5 transition-colors">
                                            <td class="py-3.5 px-2 font-bold text-slate-800 dark:text-slate-200">
                                                <span class="block product-name">💎 {{ $product->nama_paket }}</span>
                                                <span class="block text-[10px] text-slate-550 dark:text-slate-550 font-normal product-id">ID: {{ $product->id }}</span>
                                            </td>
                                            <td class="py-3.5 px-2 text-slate-600 dark:text-slate-350 font-semibold text-xs whitespace-nowrap">
                                                Rp {{ number_format($product->harga, 0, ',', '.') }}
                                            </td>
                                            <td class="py-3.5 px-2 text-center">
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold {{ $product->stok > 10 ? 'bg-emerald-600/10 text-emerald-600 dark:text-emerald-400' : 'bg-rose-600/10 text-rose-600 dark:text-rose-450' }}">
                                                    {{ $product->stok }}
                                                </span>
                                            </td>
                                            <td class="py-3.5 px-2 text-right">
                                                <div class="flex items-center gap-1.5 justify-end">
                                                    <button type="button" onclick="openEditProductModal({{ json_encode($product) }})" class="px-2.5 py-1 rounded-lg font-bold bg-blue-600 hover:bg-blue-500 text-white text-[10px] shadow-sm">Edit</button>
                                                    <form action="{{ route('admin.product.delete', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk {{ $product->nama_paket }}?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="px-2 py-1 rounded-lg font-bold bg-rose-600 hover:bg-rose-500 text-white text-[10px] shadow-sm">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Pesanan Log (All Users) -->
                <div class="lg:col-span-7 bg-white dark:bg-slate-900/40 backdrop-blur-md border border-slate-200 dark:border-white/5 rounded-3xl p-6 shadow-sm dark:shadow-xl space-y-4">
                    <div>
                        <h3 class="font-outfit font-bold text-lg text-slate-900 dark:text-white">Riwayat Pesanan Pelanggan</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Menampilkan semua riwayat pembelian diamond oleh semua pengguna.</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-slate-200 dark:border-white/5 text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                                    <th class="py-3 px-3">Tanggal</th>
                                    <th class="py-3 px-3">Pelanggan</th>
                                    <th class="py-3 px-3">ID Game</th>
                                    <th class="py-3 px-3">Paket</th>
                                    <th class="py-3 px-3">Total</th>
                                    <th class="py-3 px-3 text-center">Status</th>
                                    <th class="py-3 px-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-white/5 text-xs">
                                @forelse($pesanans as $tx)
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-white/5 transition-colors">
                                        <td class="py-4 px-3 text-slate-500 dark:text-slate-400">
                                            {{ $tx->created_at->setTimezone('Asia/Jakarta')->format('d M H:i') }} WIB
                                        </td>
                                        <td class="py-4 px-3">
                                            <span class="block font-bold text-slate-800 dark:text-slate-200">{{ $tx->user->name ?? 'Guest' }}</span>
                                            <span class="block text-[10px] text-slate-550 dark:text-slate-550">{{ $tx->user->email ?? '-' }}</span>
                                        </td>
                                        <td class="py-4 px-3 font-semibold text-slate-800 dark:text-slate-200">
                                            {{ $tx->game_user_id }} <span class="text-[10px] text-slate-400 font-normal">({{ $tx->zone_id }})</span>
                                        </td>
                                        <td class="py-4 px-3 font-medium text-slate-700 dark:text-slate-350">
                                            {{ $tx->paket }}
                                        </td>
                                        <td class="py-4 px-3 font-bold text-blue-600 dark:text-blue-400">
                                            Rp {{ number_format($tx->harga, 0, ',', '.') }}
                                        </td>
                                        <td class="py-4 px-3 text-center">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full font-bold bg-emerald-600/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400">
                                                {{ $tx->status }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-3 text-right">
                                            <a href="{{ route('riwayat.show', $tx->id) }}" class="text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300 font-bold transition-colors">Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-8 text-center text-slate-550 dark:text-slate-400 font-medium">
                                            Belum ada pesanan masuk.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="pt-4 border-t border-slate-200 dark:border-white/5">
                        {{ $pesanans->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal: Tambah Produk Baru -->
    <div id="add-product-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/60 backdrop-blur-sm hidden">
        <div class="bg-white dark:bg-slate-900 border border-slate-250 dark:border-white/10 rounded-3xl p-6 max-w-md w-full shadow-2xl relative space-y-4">
            <button onclick="toggleAddProductModal(false)" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 dark:hover:text-slate-250 text-xl font-bold">✕</button>
            <div>
                <h3 class="font-outfit font-bold text-lg text-slate-900 dark:text-white">Tambah Produk Baru</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400">Buat paket diamond baru yang otomatis tayang di halaman depan.</p>
            </div>
            
            <form action="{{ route('admin.product.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="space-y-1">
                    <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Nama Paket</label>
                    <input type="text" name="nama_paket" placeholder="Contoh: 100 Diamond" required class="w-full bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-900 dark:text-white placeholder-slate-450 dark:placeholder-slate-500 outline-none">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="space-y-1">
                        <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Harga (Rupiah)</label>
                        <input type="number" name="harga" min="0" placeholder="Contoh: 25000" required class="w-full bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-900 dark:text-white placeholder-slate-450 dark:placeholder-slate-500 outline-none">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Stok Awal</label>
                        <input type="number" name="stok" min="0" value="100" required class="w-full bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-900 dark:text-white outline-none">
                    </div>
                </div>
                <button type="submit" class="w-full py-2.5 rounded-xl font-bold bg-blue-600 hover:bg-blue-500 text-white text-xs shadow-lg shadow-blue-500/10 hover:scale-[1.01] active:scale-[0.99] transition-all duration-200">➕ Tambah Produk</button>
            </form>
        </div>
    </div>

    <!-- Modal: Edit Produk -->
    <div id="edit-product-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/60 backdrop-blur-sm hidden">
        <div class="bg-white dark:bg-slate-900 border border-slate-250 dark:border-white/10 rounded-3xl p-6 max-w-md w-full shadow-2xl relative space-y-4">
            <button onclick="toggleEditProductModal(false)" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 dark:hover:text-slate-250 text-xl font-bold">✕</button>
            <div>
                <h3 class="font-outfit font-bold text-lg text-slate-900 dark:text-white">Edit Produk</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400">Ubah informasi produk paket diamond.</p>
            </div>
            
            <form id="edit-product-form" action="" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')
                <div class="space-y-1">
                    <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Nama Paket</label>
                    <input type="text" id="edit_nama_paket" name="nama_paket" required class="w-full bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-900 dark:text-white outline-none">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="space-y-1">
                        <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Harga (Rupiah)</label>
                        <input type="number" id="edit_harga" name="harga" min="0" required class="w-full bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-900 dark:text-white outline-none">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Stok</label>
                        <input type="number" id="edit_stok" name="stok" min="0" required class="w-full bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-900 dark:text-white outline-none">
                    </div>
                </div>
                <button type="submit" class="w-full py-2.5 rounded-xl font-bold bg-blue-600 hover:bg-blue-500 text-white text-xs shadow-lg shadow-blue-500/10 hover:scale-[1.01] active:scale-[0.99] transition-all duration-200">💾 Simpan Perubahan</button>
            </form>
        </div>
    </div>

    <!-- Script to toggle modals -->
    <script>
        function toggleAddProductModal(show) {
            const modal = document.getElementById('add-product-modal');
            if (show) {
                modal.classList.remove('hidden');
            } else {
                modal.classList.add('hidden');
            }
        }

        function toggleEditProductModal(show) {
            const modal = document.getElementById('edit-product-modal');
            if (show) {
                modal.classList.remove('hidden');
            } else {
                modal.classList.add('hidden');
            }
        }

        function openEditProductModal(product) {
            const form = document.getElementById('edit-product-form');
            form.action = "{{ url('/admin/product') }}/" + product.id;
            
            document.getElementById('edit_nama_paket').value = product.nama_paket;
            document.getElementById('edit_harga').value = product.harga;
            document.getElementById('edit_stok').value = product.stok;
            
            toggleEditProductModal(true);
        }

        // Auto open modals if validation errors exist
        @if ($errors->any())
            document.addEventListener('DOMContentLoaded', function() {
                toggleAddProductModal(true);
            });
        @endif

        // Close modals when clicking outside content area
        window.addEventListener('click', function(event) {
            const addModal = document.getElementById('add-product-modal');
            const editModal = document.getElementById('edit-product-modal');
            if (event.target === addModal) {
                toggleAddProductModal(false);
            }
            if (event.target === editModal) {
                toggleEditProductModal(false);
            }
        });

        // Live search for products in stock management
        const searchInput = document.getElementById('search-product');
        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                const query = e.target.value.toLowerCase().trim();
                const rows = document.querySelectorAll('#products-table-body tr');
                
                rows.forEach(row => {
                    const nameEl = row.querySelector('.product-name');
                    const idEl = row.querySelector('.product-id');
                    
                    if (nameEl && idEl) {
                        const productName = nameEl.textContent.toLowerCase();
                        const productId = idEl.textContent.toLowerCase();
                        
                        if (productName.includes(query) || productId.includes(query)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    }
                });
            });
        }
    </script>
</x-app-layout>
