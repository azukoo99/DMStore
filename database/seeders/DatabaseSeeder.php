<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeding admin account
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin DiamondStore',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // Seeding initial products
        $initialProducts = [
            ['nama_paket' => '11 Diamond', 'harga' => 3000, 'stok' => 100],
            ['nama_paket' => '86 Diamond', 'harga' => 20000, 'stok' => 100],
            ['nama_paket' => '172 Diamond', 'harga' => 40000, 'stok' => 100],
            ['nama_paket' => '257 Diamond', 'harga' => 60000, 'stok' => 100],
            ['nama_paket' => '514 Diamond', 'harga' => 115000, 'stok' => 100],
            ['nama_paket' => '706 Diamond', 'harga' => 150000, 'stok' => 100],
            ['nama_paket' => '1.069 Diamond', 'harga' => 225000, 'stok' => 100],
            ['nama_paket' => '1.412 Diamond', 'harga' => 300000, 'stok' => 100],
        ];

        foreach ($initialProducts as $product) {
            \App\Models\Product::updateOrCreate(
                ['nama_paket' => $product['nama_paket']],
                $product
            );
        }
    }
}
