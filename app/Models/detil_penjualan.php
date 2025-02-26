<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detil_penjualan extends Model
{
    use HasFactory;

    protected $table = 'detil_penjualan'; // Nama tabel
    protected $primaryKey = 'id_transaksi_detil'; // Jika ada primary key lain
    public $timestamps = false;

    protected $fillable = [
        'id_transaksi',
        'id_barang',
        'jml_barang',
        'harga_satuan',
    ];

    // Relasi ke penjualan
    public function penjualan()
    {
        return $this->belongsTo(penjualan::class, 'id_transaksi', 'id_transaksi');
    }

    // Relasi ke barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }
}