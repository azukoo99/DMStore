<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Product;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Tampilkan halaman dashboard admin.
     */
    public function index()
    {
        $today = Carbon::today();

        // 1. Hitung Statistik Harian
        $pesanansToday = Pesanan::whereDate('created_at', $today)->count();
        $successfulToday = Pesanan::whereDate('created_at', $today)->where('status', 'Selesai')->count();
        $revenueToday = Pesanan::whereDate('created_at', $today)->where('status', 'Selesai')->sum('harga');

        $diamondsToday = Pesanan::whereDate('created_at', $today)
            ->where('status', 'Selesai')
            ->get()
            ->sum(function ($tx) {
                // Ekstrak nilai angka dari nama paket (misal "1.069 Diamond" -> 1069)
                if (preg_match('/^([0-9.]+)\s+Diamond/', $tx->paket, $matches)) {
                    return (int) str_replace('.', '', $matches[1]);
                }
                return 0;
            });

        $successRate = $pesanansToday > 0 
            ? round(($successfulToday / $pesanansToday) * 100, 1) 
            : 100;

        $stats = [
            'pesanans_today' => $pesanansToday,
            'revenue_today' => $revenueToday,
            'diamonds_today' => $diamondsToday,
            'success_rate' => $successRate,
        ];

        // 2. Ambil semua produk diamond
        $products = Product::orderBy('id', 'asc')->get();

        // 3. Ambil riwayat pesanan seluruh pelanggan
        $pesanans = Pesanan::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.dashboard', compact('stats', 'products', 'pesanans'));
    }

    /**
     * Perbarui detail produk (nama, harga, stok).
     */
    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'nama_paket' => ['required', 'string'],
            'harga' => ['required', 'integer', 'min:0'],
            'stok' => ['required', 'integer', 'min:0'],
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'nama_paket' => $request->nama_paket,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);

        return back()->with('status', "Produk {$product->nama_paket} berhasil diperbarui!");
    }

    /**
     * Tambah produk diamond baru.
     */
    public function storeProduct(Request $request)
    {
        $request->validate([
            'nama_paket' => ['required', 'string'],
            'harga' => ['required', 'integer', 'min:0'],
            'stok' => ['required', 'integer', 'min:0'],
        ]);

        $product = Product::create([
            'nama_paket' => $request->nama_paket,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);

        return back()->with('status', "Produk {$product->nama_paket} berhasil ditambahkan!");
    }

    /**
     * Hapus produk diamond.
     */
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return back()->with('status', "Produk {$product->nama_paket} berhasil dihapus!");
    }
}
