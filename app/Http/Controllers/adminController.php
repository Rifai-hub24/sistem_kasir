<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barang;
use App\Models\penjualan;
use App\Models\pelanggan;
use App\Models\detil_penjualan;
use App\Models\User;


class adminController extends Controller
{
    /**
     * Tampilkan semua data di halaman admin.
     */
    public function tampiladmin()
    {
        $barangs = barang::all();
        $penjualans = penjualan::all();
        $pelanggans = pelanggan::all();
        $detil_penjualans = detil_penjualan::all();
        $Users = user::all();

        return view('admin', compact('barangs', 'penjualans', 'pelanggans', 'detil_penjualans','Users'));
    }

    public function tampilKaryawan() {
        $barangs = barang::all();
        $penjualans = penjualan::all();
        $pelanggans = pelanggan::all();
        $detil_penjualans = detil_penjualan::all();
    
        return view('karyawan', compact('barangs', 'penjualans', 'pelanggans', 'detil_penjualans'));
    }
    
    /**
     * Tampilkan form untuk tambah data Barang.
     */
    public function createbarang()
    {
        return view('posts');
    }

    /**
     * Simpan data Barang.
     */
    public function storebarang(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|min:3',
            'harga_barang' => 'required|numeric',
            'stock' => 'required|integer'
        ]);

        // Simpan data barang, ID akan otomatis di-generate
        barang::create($request->all());

        return redirect()->route('admin')->with('success', 'Barang berhasil ditambahkan!');
    }

    /**
     * Tampilkan form untuk tambah data Penjualan.
     */
    public function from()
    {
        $pelanggans = pelanggan::all();
        $barangs = barang::all(); // Ambil data barang dari database
        return view('from', compact('pelanggans', 'barangs')); 
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required|integer|exists:pelanggan,id_pelanggan',
            'tgl_transaksi' => 'required|date',
            'total_transaksi' => 'required|numeric',
            'detil_penjualan' => 'required|array',
            'detil_penjualan.*.id_barang' => 'required|integer|exists:barang,id_barang',
            'detil_penjualan.*.jml_barang' => 'required|integer|min:1',
            'detil_penjualan.*.harga_satuan' => 'required|numeric|min:1',
        ]);
    
        // Simpan data penjualan
        $penjualan = Penjualan::create([
            'id_pelanggan' => $request->id_pelanggan,
            'tgl_transaksi' => now(),
            'total_transaksi' => $request->total_transaksi,
        ]);
    
        // Simpan detail penjualan dan kurangi stok
        foreach ($request->detil_penjualan as $detil) {
            $barang = Barang::findOrFail($detil['id_barang']);
            
            if ($barang->stock < $detil['jml_barang']) {
                return redirect()->back()->withErrors(['error' => "Stok barang '{$barang->nama_barang}' tidak mencukupi."]);
            }
    
            $barang->stock -= $detil['jml_barang'];
            $barang->save();
    
            // Simpan detil penjualan
            $penjualan->detilPenjualan()->create([
                'id_barang' => $detil['id_barang'],
                'jml_barang' => $detil['jml_barang'],
                'harga_satuan' => $detil['harga_satuan'],
            ]);
        }
    
        // Mengembalikan response dengan data untuk invoice
        return response()->json([
            'success' => true,
            'penjualan' => $penjualan,
            'detil_penjualan' => $penjualan->detilPenjualan,
            'message' => 'Transaksi berhasil disimpan!',
        ]);
    }
    

    public function getPelanggan(Request $request)
    {
        $pelanggan = pelanggan::find($request->id_pelanggan);

        if ($pelanggan) {
            return response()->json([
                'nama' => $pelanggan->nama,
                'gender' => $pelanggan->gender
            ]);
        }

        return response()->json(['error' => 'Pelanggan tidak ditemukan'], 404);
    }

    public function getBarang(Request $request)
    {
        $barang = barang::find($request->id_barang);

        if ($barang) {
            return response()->json([
                'nama_barang' => $barang->nama_barang,
                'harga_barang' => $barang->harga_barang,
                'stock' => $barang->stock,
            ]);
        }

        return response()->json(['error' => 'Barang tidak ditemukan'], 404);
    }

    /**
     * Tampilkan form untuk tambah data Pelanggan.
     */
    public function createpelanggan()
    {
        return view('post_pelanggan');
    }

    /**
     * Simpan data Pelanggan.
     */
    public function storepelanggan(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:3',
            'gender' => 'required|in:L,P'
        ]);

        // Simpan data pelanggan, ID akan otomatis di-generate
        pelanggan::create($request->all());

        return redirect()->route('admin')->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    public function createUser()
    {
        // Tampilkan form tambah user
        return view('post_user');
    }

    public function storeUser(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string|max:50|unique:user',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,karyawan',
        ]);

        // Simpan data user ke database
        User::create([
            'username' => $request->input('username'),
            'password' => $request->input('password'), // Simpan password apa adanya
            'role' => $request->input('role'),
        ]);
        
        // Redirect dengan pesan sukses
        return redirect()->route('admin')->with('success', 'User berhasil ditambahkan!');
    }

    // Menampilkan form edit Barang
    public function editbarang($id_barang)
    {
       $barang = barang::findOrFail($id_barang);
       return view('edit_barang', compact('barang'));
    }

    // Menyimpan perubahan data Barang
    public function updatebarang(Request $request, $id_barang)
    {
        $request->validate([
           'nama_barang' => 'required|min:3',
           'harga_barang' => 'required|numeric',
           'stock' => 'required|integer',
        ]);

        $barang = barang::findOrFail($id_barang);
        $barang->update($request->all());

        return redirect()->route('admin')->with('success', 'Barang berhasil diupdate!');
    }
    
    public function editpelanggan($id_pelanggan)
    {
        // Ambil data pelanggan berdasarkan ID
        $pelanggan = pelanggan::findOrFail($id_pelanggan);
    
        // Pastikan data ditemukan
        if (!$pelanggan) {
            return redirect()->route('admin')->with('error', 'Data pelanggan tidak ditemukan.');
        }
    
        // Tampilkan form edit dengan data pelanggan
        return view('edit_pelanggan', compact('pelanggan'));
    }
    
    public function updatepelanggan(Request $request, $id_pelanggan)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|min:3',
            'gender' => 'required|in:Laki-laki,Perempuan',
        ]);
    
        // Temukan data pelanggan berdasarkan ID
        $pelanggan = pelanggan::findOrFail($id_pelanggan);
    
        // Pastikan data ditemukan
        if (!$pelanggan) {
            return redirect()->route('admin')->with('error', 'Data pelanggan tidak ditemukan.');
        }
    
        // Mengubah gender menjadi L atau P
        $gender = ($request->input('gender') == 'Laki-laki') ? 'L' : 'P';
    
        // Update data pelanggan dengan data dari form
        $pelanggan->update([
            'nama' => $request->input('nama'),
            'gender' => $gender,
        ]);
    
        // Redirect dengan pesan sukses
        return redirect()->route('admin')->with('success', 'Pelanggan berhasil diupdate!');
    }

    public function editUser($id_user)
{
    // Cari user berdasarkan ID
    $user = User::findOrFail($id_user);

    // Tampilkan form edit dengan data user
    return view('edit_user', compact('user'));
}

public function updateUser(Request $request, $id_user)
{
    // Validasi input
    $request->validate([
        'username' => 'required|string|max:50|unique:user,username,' . $id_user . ',id_user',
        'password' => 'nullable|string|min:6|max:50', // Password boleh kosong
        'role' => 'required|in:admin,karyawan',
    ]);

    // Cari user berdasarkan ID
    $user = User::findOrFail($id_user);

    // Update data user
    $user->username = $request->input('username');
    $user->role = $request->input('role');

    // Update password hanya jika diisi
    if ($request->input('password')) {
        $user->password = $request->input('password'); // Simpan password tanpa hashing
    }

    $user->save();

    // Redirect dengan pesan sukses
    return redirect()->route('admin')->with('success', 'User berhasil diperbarui!');
}

    
    public function deletebarang($id_barang)
    {
        // Find the barang by ID
        $barang = barang::findOrFail($id_barang);
    
        // Delete the barang
        $barang->delete();
    
        // Redirect with success message
        return redirect()->route('admin')->with('success', 'Barang has been deleted!');
    }

    public function deletepelanggan($id_pelanggan)
    {
        // Cari pelanggan berdasarkan ID
        $pelanggan = pelanggan::findOrFail($id_pelanggan);
    
        // Hapus pelanggan
        $pelanggan->delete();
    
        // Redirect dengan pesan sukses
        return redirect()->route('admin')->with('success', 'Pelanggan berhasil dihapus!');
    }


    public function deleteUser($id_user)
    {
    // Cari user berdasarkan ID
    $user = User::findOrFail($id_user);

    // Hapus user
    $user->delete();

    // Redirect dengan pesan sukses
    return redirect()->route('admin')->with('success', 'User berhasil dihapus!');
    }

    public function createpelanggankaryawan()
    {
      return view('post_pelanggan_karyawan');
    }

/**
 * Simpan data Pelanggan.
 */
   public function storepelanggankaryawan(Request $request)
   {
      $request->validate([
          'nama' => 'required|min:3',
          'gender' => 'required|in:L,P'
      ]);

      // Simpan data pelanggan, ID akan otomatis di-generate
      pelanggan::create($request->all());

       return redirect()->route('karyawan')->with('success', 'Pelanggan berhasil ditambahkan!');
   }

    public function editpelanggankaryawan($id_pelanggan)
    {
      // Ambil data pelanggan berdasarkan ID
      $pelanggan = pelanggan::findOrFail($id_pelanggan);

      // Pastikan data ditemukan
      if (!$pelanggan) {
        return redirect()->route('karyawan')->with('error', 'Data pelanggan tidak ditemukan.');
      }

      // Tampilkan form edit dengan data pelanggan
      return view('edit_pelanggan_karyawan', compact('pelanggan'));
    }

    public function updatepelanggankaryawan(Request $request, $id_pelanggan)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|min:3',
            'gender' => 'required|in:Laki-laki,Perempuan',
        ]);
    
        // Temukan data pelanggan berdasarkan ID
        $pelanggan = pelanggan::findOrFail($id_pelanggan);
    
        // Pastikan data ditemukan
        if (!$pelanggan) {
            return redirect()->route('karyawan')->with('error', 'Data pelanggan tidak ditemukan.');
        }
    
        // Mengubah gender menjadi L atau P
        $gender = ($request->input('gender') == 'Laki-laki') ? 'L' : 'P';
    
        // Update data pelanggan dengan data dari form
        $pelanggan->update([
            'nama' => $request->input('nama'),
            'gender' => $gender,
        ]);
    
        // Redirect dengan pesan sukses
        return redirect()->route('karyawan')->with('success', 'Pelanggan berhasil diupdate!');
    }

    public function deletepelanggankaryawan($id_pelanggan)
    {
        // Cari pelanggan berdasarkan ID
        $pelanggan = pelanggan::findOrFail($id_pelanggan);
    
        // Hapus pelanggan
        $pelanggan->delete();
    
        // Redirect dengan pesan sukses
        return redirect()->route('karyawan')->with('success', 'Pelanggan berhasil dihapus!');
    }
    
}