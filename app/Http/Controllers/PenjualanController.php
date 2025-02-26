<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\detil_penjualan;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
            'tgl_transaksi' => 'required|date',
            'total_transaksi' => 'required|numeric',
            'detil_penjualan' => 'required|array',
            'detil_penjualan.*.id_barang' => 'required|exists:barangs,id_barang',
            'detil_penjualan.*.jml_barang' => 'required|integer|min:1',
            'detil_penjualan.*.harga_satuan' => 'required|numeric|min:0',
        ]);

        // Mulai transaksi database
        DB::beginTransaction();
        try {
            // Simpan data penjualan
            $penjualan = Penjualan::create([
                'id_pelanggan' => $request->id_pelanggan,
                'tgl_transaksi' => $request->tgl_transaksi,
                'total_transaksi' => $request->total_transaksi,
            ]);

            // Simpan data detil penjualan
            foreach ($request->detil_penjualan as $detil) {
                detil_penjualan::create([
                    'id_penjualan' => $penjualan->id_penjualan,
                    'id_barang' => $detil['id_barang'],
                    'jml_barang' => $detil['jml_barang'],
                    'harga_satuan' => $detil['harga_satuan'],
                ]);
            }

            // Commit transaksi
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil disimpan!',
                'penjualan' => $penjualan,
            ]);

        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}