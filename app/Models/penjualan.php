<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan'; // Nama tabel
    protected $primaryKey = 'id_transaksi'; // Primary key
    public $timestamps = false; // Nonaktifkan timestamps jika tidak digunakan

    protected $fillable = [
        'id_pelanggan',
        'tgl_transaksi',
        'total_transaksi',
    ];

    // Relasi ke detil_penjualan
    public function detilPenjualan()
    {
        return $this->hasMany(detil_penjualan::class, 'id_transaksi', 'id_transaksi');
    }
}
