<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PesananController;

Route::get('/', function () {
    if (auth()->check() && auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    $products = \App\Models\Product::orderBy('id', 'asc')->get();
    return view('welcome', compact('products'));
});

Route::get('/dashboard', function () {
    if (auth()->check() && auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::post('/product', [AdminController::class, 'storeProduct'])->name('product.store');
    Route::patch('/product/{id}', [AdminController::class, 'updateProduct'])->name('product.update');
    Route::delete('/product/{id}', [AdminController::class, 'deleteProduct'])->name('product.delete');
});

Route::get('/cek-akun', [PesananController::class, 'checkAccount'])->name('cek-akun');

Route::middleware('auth')->group(function () {
    Route::get('/riwayat', [PesananController::class, 'index'])->name('riwayat');
    Route::get('/riwayat/{id}', [PesananController::class, 'show'])->name('riwayat.show');
    Route::post('/topup', [PesananController::class, 'store'])->name('topup.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';
