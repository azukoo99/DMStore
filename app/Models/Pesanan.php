<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'game_user_id',
        'zone_id',
        'paket',
        'harga',
        'pembayaran',
        'status',
        'email',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
