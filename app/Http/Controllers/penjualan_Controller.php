<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;

class PenjualanController extends Controller
{
    public function index()
    {
        // Mengambil data dari penjualan dan detil_penjualan
        $data = Penjualan::with('detilPenjualan')->get();

        return view('penjualan.index', compact('data'));
    }
}
