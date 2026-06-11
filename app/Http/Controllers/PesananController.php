<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PesananController extends Controller
{
    /**
     * Tampilkan riwayat pesanan pengguna.
     */
    public function index()
    {
        $pesanans = Auth::user()->pesanans()->orderBy('created_at', 'desc')->get();
        return view('riwayat', compact('pesanans'));
    }

    /**
     * Simpan pesanan top up baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'string'],
            'zone_id' => ['required', 'string'],
            'paket' => ['required', 'integer'], // ID produk di DB
            'pembayaran' => ['required', 'string'],
            'email' => ['nullable', 'email'],
        ]);

        $paketKey = $request->paket;

        // Cari produk berdasarkan primary key ID di DB
        $product = Product::find($paketKey);
        if (!$product) {
            return back()->withErrors(['paket' => 'Paket diamond tidak valid.']);
        }

        if ($product->stok <= 0) {
            return back()->withErrors(['paket' => 'Stok diamond untuk paket ini habis!']);
        }

        // Kurangi stok
        $product->decrement('stok');

        // Buat data pesanan
        Pesanan::create([
            'user_id' => Auth::id(),
            'game_user_id' => $request->user_id,
            'zone_id' => $request->zone_id,
            'paket' => $product->nama_paket,
            'harga' => $product->harga,
            'pembayaran' => strtoupper($request->pembayaran),
            'status' => 'Selesai', // Default sukses
            'email' => $request->email,
        ]);

        return redirect()->route('riwayat')->with('status', 'Top up berhasil diproses! Terima kasih.');
    }

    /**
     * Tampilkan detail pesanan (invoice / struk pembelian).
     */
    public function show($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        // Pastikan hanya pemilik pesanan atau admin yang bisa mengakses detail
        abort_if(Auth::id() !== $pesanan->user_id && Auth::user()->role !== 'admin', 403);

        return view('detail', compact('pesanan'));
    }

    /**
     * Cek username akun Mobile Legends menggunakan API APIGames.
     */
    public function checkAccount(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'string'],
            'zone_id' => ['required', 'string'],
        ]);

        $userId = $request->user_id;
        $zoneId = $request->zone_id;

        $merchantId = config('services.apigames.merchant_id');
        $secretKey = config('services.apigames.secret_key');

        // Jika salah satu konfigurasi kosong, gunakan mock fallback
        if (empty($merchantId) || empty($secretKey)) {
            // Simulasi latency jaringan
            usleep(400000); // 0.4 detik

            // List nama keren untuk mock
            $nicknames = [
                'GamerSultan_⚡', 
                'MLBB_Pro_Player', 
                'AntiGravity_ML', 
                'SkyFighter_⚔️', 
                'ShadowAssassin', 
                'Valkyrie_Queen', 
                'StarLord_99', 
                'RogueShadow', 
                'ViperML', 
                'Dominator_🔥',
                'HyperCarry_☠️',
                'Gladiator_ML'
            ];

            // Tentukan index secara deterministik agar ID/Zone yang sama menghasilkan nama yang sama
            $hash = crc32($userId . '|' . $zoneId);
            $index = abs($hash) % count($nicknames);
            $username = $nicknames[$index];

            return response()->json([
                'success' => true,
                'username' => $username,
                'is_mock' => true,
            ]);
        }

        // Jalankan request ke API asli dari APIGames
        $signature = md5($merchantId . $secretKey);
        
        try {
            // APIGames meminta user_id digabungkan dengan zone_id (contoh: 1154702152591) untuk Mobile Legends
            $apiUserId = $userId . $zoneId;

            $response = Http::timeout(8)->get("https://v1.apigames.id/merchant/{$merchantId}/cek-username/mobilelegend", [
                'user_id' => $apiUserId,
                'signature' => $signature,
            ]);

            if ($response->successful()) {
                $resData = $response->json();
                
                // Cek data response berdasarkan dokumentasi APIGames
                if (isset($resData['status']) && $resData['status'] == 1 && isset($resData['data']['username'])) {
                    return response()->json([
                        'success' => true,
                        'username' => $resData['data']['username'],
                        'is_mock' => false,
                    ]);
                }
                
                // Parse error message dari APIGames
                $errorMsg = $resData['error_msg'] ?? $resData['message'] ?? 'ID Game atau Zone ID tidak ditemukan di APIGames.';
                
                // Log untuk admin
                \Illuminate\Support\Facades\Log::warning('APIGames Cek Akun Gagal:', [
                    'user_id' => $userId,
                    'zone_id' => $zoneId,
                    'response' => $resData
                ]);

                return response()->json([
                    'success' => false,
                    'message' => $errorMsg,
                    'debug' => $resData,
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghubungi server APIGames. Status: ' . $response->status(),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan koneksi API: ' . $e->getMessage(),
            ]);
        }
    }
}
