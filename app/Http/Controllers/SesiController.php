<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    // Fungsi index untuk menangani pencarian berdasarkan nomor transaksi
    public function index(Request $request)
    {
        $search = $request->input('search'); // Mengambil input pencarian

        // Jika ada input pencarian, cari di model Order berdasarkan no_transaksi
        if ($search) {
            $orders = Order::where('no_transaksi', 'like', '%' . $search . '%')->get();
        } else {
            $orders = []; // Jika tidak ada pencarian, tampilkan array kosong atau bisa menampilkan semua order
        }

        // Kembalikan view dengan hasil pencarian (jika ada)
        return view('login', compact('orders', 'search'));
    }

    // Fungsi login untuk melakukan autentikasi pengguna
    function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        // Menyiapkan data login
        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // Cek autentikasi dan alihkan pengguna sesuai role
        if (Auth::attempt($infologin)) {
            // Berdasarkan role pengguna, arahkan ke halaman yang sesuai
            if (Auth::user()->role == 'admin') {
                return redirect('admin/admin');
            } elseif (Auth::user()->role == 'petugas') {
                return redirect('admin/petugas');
            } elseif (Auth::user()->role == 'pimpinan') {
                return redirect('admin/pimpinan');
            }
        } else {
            // Jika login gagal, tampilkan error
            return redirect('')->withErrors('Username dan password yang dimasukan tidak sesuai')->withInput();
        }
    }

    // Fungsi logout untuk mengeluarkan pengguna dari sistem
    function logout()
    {
        Auth::logout(); // Logout pengguna
        return redirect(''); // Kembali ke halaman login setelah logout
    }
}
