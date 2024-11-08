<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    public function index(Request $request)
{
    // Ambil input pencarian dari request
    $search = $request->input('search');
    
    // Jika ada input pencarian, cari di model Order berdasarkan no_transaksi
    if ($search) {
        $orders = Order::where('no_transaksi', 'like', '%' . $search . '%')->get();
    } else {
        $orders = []; // Tidak ada pencarian, kosongkan atau bisa menampilkan semua order
    }
    
    // Kembalikan view dengan hasil pencarian (jika ada)
    return view('login', compact('orders', 'search'));
}


    function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
           if (Auth::user()->role == 'admin'){
            return redirect('admin/admin');
           } elseif (Auth::user()->role == 'petugas') {
            return redirect('admin/petugas');
           } elseif (Auth::user()->role == 'pimpinan') {
            return redirect('admin/pimpinan');
           }
        } else {
            return redirect('')->withErrors('Username dan password yang dimasukan tidak sesuai')->withInput();
        }
    }

    function logout() {
        Auth::logout();
        return redirect('');
    }
}
