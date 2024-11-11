<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

// Definisi class OfficerController untuk mengelola data pengguna dengan peran petugas
class OfficerController extends Controller
{
    // Fungsi index untuk menampilkan daftar semua petugas
    public function index()
    {
        // Mengambil data semua pengguna dengan peran "petugas" dari tabel users
        $officers = User::where('role', 'petugas')->get(); 
        // Mengirim data petugas ke view officers.index
        return view('officers.index', compact('officers'));
    }

    // Fungsi create untuk menampilkan form tambah petugas
    public function create()
    {
        // Mengembalikan view officers.create untuk menampilkan form
        return view('officers.create');
    }

    // Fungsi store untuk menyimpan data petugas baru
    public function store(Request $request)
    {
        // Melakukan validasi data yang dikirim melalui form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Email harus unik
            'password' => 'required|string|min:6|confirmed', // Password minimal 6 karakter dan dikonfirmasi
        ]);

        // Menyimpan data petugas baru ke dalam database dengan role "petugas"
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'petugas',  // Menetapkan peran sebagai petugas
            'password' => bcrypt($request->password), // Mengenkripsi password
        ]);

        // Redirect ke halaman index petugas dengan pesan sukses
        return redirect()->route('officers.index')->with('success', 'Petugas berhasil ditambahkan');
    }

    // Fungsi edit untuk menampilkan form edit petugas
    public function edit(User $officer)
    {
        // Mengirim data petugas yang akan diedit ke view officers.edit
        return view('officers.edit', compact('officer'));
    }

    // Fungsi update untuk memperbarui data petugas
    public function update(Request $request, User $officer)
    {
        // Melakukan validasi data input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $officer->id, // Email harus unik kecuali untuk email petugas ini
            'password' => 'nullable|string|min:6|confirmed', // Password boleh kosong jika tidak diubah
        ]);

        // Mengupdate data petugas di database
        $officer->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $officer->password, // Mengupdate password jika ada input baru
        ]);

        // Redirect ke halaman index petugas dengan pesan sukses
        return redirect()->route('officers.index')->with('success', 'Data petugas berhasil diperbarui');
    }

    // Fungsi destroy untuk menghapus data petugas
    public function destroy(User $officer)
    {
        // Menghapus data petugas dari database
        $officer->delete();

        // Redirect ke halaman index petugas dengan pesan sukses
        return redirect()->route('officers.index')->with('success', 'Petugas berhasil dihapus');
    }
}
