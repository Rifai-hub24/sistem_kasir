<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('login');
    }

    // Menangani login (POST)
    public function handleLogin(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_user' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        // Ambil data pengguna dari database
        $user = DB::table('user')
            ->where('id_user', $request->id_user)
            ->where('username', $request->username)
            ->first();

        // Cek apakah user ditemukan dan password valid (plain text)
        if ($user && $request->password === $user->password) {
            // Autentikasi pengguna dengan ID
            Auth::loginUsingId($user->id_user);

            // Redirect berdasarkan role pengguna
            if ($user->role === 'admin') {
                return redirect()->route('admin');  // Halaman admin
            } elseif ($user->role === 'karyawan') {
                return redirect()->route('karyawan');  // Halaman karyawan
            }
        }

        // Jika login gagal
        return back()->with('error', 'ID User, Username, atau Password salah!');
    }
}
