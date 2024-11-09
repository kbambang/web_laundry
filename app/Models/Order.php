<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected static function boot()
{
    parent::boot();

    static::creating(function ($order) {
        // Buat nilai no_transaksi jika belum ada
        if (empty($order->no_transaksi)) {
            $order->no_transaksi = 'TRX' . time() . rand(1000, 9999);
        }
    });
}

    protected $fillable = [
        'konsumen_id',
        'no_transaksi', 
        'jenis_layanan_id',
        'jenis_pembayaran_id',
        'jumlah',
        'total_harga',
        'status'
    ];

    // Relasi ke Konsumen
    public function konsumen()
    {
        return $this->belongsTo(Konsumen::class);
    }

    // Relasi ke Petugas

    // Relasi ke Jenis Layanan
    public function jenisLayanan()
    {
        return $this->belongsTo(JenisLayanan::class);
    }

    // Relasi ke Jenis Pembayaran
    public function jenisPembayaran()
    {
        return $this->belongsTo(JenisPembayaran::class);
    }
}
