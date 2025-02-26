<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KasirController;

use Illuminate\Support\Facades\Route;

// Route untuk menampilkan form login
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

// Route untuk menangani pengiriman form login (POST)
Route::post('/', [LoginController::class, 'handleLogin'])->name('login.submit');

// Group route untuk admin yang dilindungi dengan middleware autentikasi
Route::middleware(['auth'])->group(function () {
    // Route untuk halaman admin
    Route::get('/admin', [adminController::class, 'tampiladmin'])->name('admin');

    Route::get('/karyawan', [adminController::class, 'tampilkaryawan'])->name('karyawan');


    // Route untuk menampilkan form tambah barang
    Route::get('/admin/create-barang', [adminController::class, 'createBarang'])->name('admin.createBarang');

    // Route untuk menyimpan data barang
    Route::post('/admin/store-barang', [adminController::class, 'storeBarang'])->name('admin.storeBarang');
   
    Route::get('/admin/create', [adminController::class, 'create'])->name('penjualan.create');
    Route::post('/admin/store', [adminController::class, 'store'])->name('penjualan.store');

    Route::get('/get-pelanggan', [AdminController::class, 'getPelanggan'])->name('get.pelanggan');
    Route::get('/get-barang', [AdminController::class, 'getBarang'])->name('get.barang');

    // Route untuk tambah pelanggan
    Route::get('/admin/createpelanggan', [adminController::class, 'createpelanggan'])->name('admin.createpelanggan');
    Route::post('/admin/storepelanggan', [adminController::class, 'storepelanggan'])->name('admin.storepelanggan');

    Route::get('/admin/add_user', [adminController::class, 'createUser'])->name('admin.add_user');
    Route::post('/admin/add_user', [adminController::class, 'storeUser'])->name('admin.store_user');

    Route::get('admin/edit_barang/{id_barang}', [adminController::class, 'editbarang'])->name('admin.editbarang');
    Route::put('admin/update_barang/{id_barang}', [adminController::class, 'updatebarang'])->name('admin.updatebarang');

    Route::get('admin/edit_pelanggan/{id_pelanggan}', [adminController::class, 'editpelanggan'])->name('admin.editpelanggan');
    Route::put('admin/update_pelanggan/{id_pelanggan}', [adminController::class, 'updatepelanggan'])->name('admin.updatepelanggan');
     
    Route::get('/admin/edit_user/{id_user}', [adminController::class, 'editUser'])->name('admin.edit_user');
    Route::post('/admin/update_user/{id_user}', [adminController::class, 'updateUser'])->name('admin.update_user'); 

    Route::delete('/admin/delete_barang/{id_barang}', [adminController::class, 'deletebarang'])->name('admin.delete_barang');
     
    Route::delete('/admin/delete_pelanggan/{id_pelanggan}', [adminController::class, 'deletepelanggan'])->name('admin.delete_pelanggan');

    Route::delete('/admin/delete_user/{id_user}', [adminController::class, 'deleteUser'])->name('admin.delete_user');
   
    // Rute untuk form yang ditambahkan
    Route::get('/from', [adminController::class, 'from'])->name('from');
    Route::post('/admin/penjualan', 'Admin\PenjualanController@store')->name('admin.penjualan.store');
    
    Route::get('/karyawan/createpelanggan', [adminController::class, 'createpelanggankaryawan'])->name('karyawan.createpelanggan');
    Route::post('/karyawan/storepelanggan', [adminController::class, 'storepelanggankaryawan'])->name('karyawan.storepelanggan');

    Route::get('karyawan/edit_pelanggan/{id_pelanggan}', [adminController::class, 'editpelanggankaryawan'])->name('karyawan.editpelanggan');
    Route::put('karyawan/update_pelanggan/{id_pelanggan}', [adminController::class, 'updatepelanggankaryawan'])->name('karyawan.updatepelanggan');

    Route::delete('/karyawan/delete_pelanggan/{id_pelanggan}', [adminController::class, 'deletepelanggankaryawan'])->name('karyawan.delete_pelanggan');
});

