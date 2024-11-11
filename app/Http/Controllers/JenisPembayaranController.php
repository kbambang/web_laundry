<?php

// Menentukan namespace dari controller ini di dalam folder App\Http\Controllers
namespace App\Http\Controllers;

// Mengimpor model JenisPembayaran dari App\Models untuk digunakan di controller ini
use App\Models\JenisPembayaran;
// Mengimpor Request dari Illuminate\Http untuk menangani data permintaan HTTP
use Illuminate\Http\Request;

// Mendefinisikan class JenisPembayaranController yang mengelola CRUD data jenis pembayaran
class JenisPembayaranController extends Controller
{
    // Fungsi index untuk menampilkan daftar semua data jenis pembayaran
    public function index()
    {
        // Mengambil semua data dari model JenisPembayaran
        $jenisPembayaran = JenisPembayaran::all();
        // Menghitung total data jenis pembayaran
        $totalJenisPembayaran = $jenisPembayaran->count(); 
        // Mengembalikan tampilan (view) 'jenis_pembayaran.index' dengan variabel $jenisPembayaran
        return view('jenis_pembayaran.index', compact('jenisPembayaran'));
    }

    // Fungsi create untuk menampilkan form menambahkan data jenis pembayaran baru
    public function create()
    {
        // Mengembalikan tampilan 'jenis_pembayaran.create'
        return view('jenis_pembayaran.create');
    }

    // Fungsi store menyimpan data baru jenis pembayaran yang dikirim dari form
    public function store(Request $request)
    {
        // Validasi data yang dikirim dari form
        $request->validate([
            'nama_pembayaran' => 'required',         // Field nama_pembayaran wajib diisi
        ]);

        // Membuat data baru jenis pembayaran menggunakan model JenisPembayaran
        JenisPembayaran::create($request->all());
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('jenis_pembayaran.index')->with('success', 'Data jenis pembayaran berhasil ditambahkan.');
    }

    // Fungsi show untuk menampilkan detail satu data jenis pembayaran
    public function show(JenisPembayaran $jenisPembayaran)
    {
        // Mengembalikan tampilan 'jenis_pembayaran.show' dengan data $jenisPembayaran
        return view('jenis_pembayaran.show', compact('jenisPembayaran'));
    }

    // Fungsi edit untuk menampilkan form edit data jenis pembayaran
    public function edit(JenisPembayaran $jenisPembayaran)
    {
        // Mengembalikan tampilan 'jenis_pembayaran.edit' dengan data $jenisPembayaran
        return view('jenis_pembayaran.edit', compact('jenisPembayaran'));
    }

    // Fungsi update menyimpan perubahan data jenis pembayaran yang telah diedit
    public function update(Request $request, JenisPembayaran $jenisPembayaran)
    {
        // Validasi data yang dikirim dari form
        $request->validate([
            'nama_pembayaran' => 'required',
        ]);

        // Mengupdate data jenis pembayaran dengan data baru
        $jenisPembayaran->update($request->all());
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('jenis_pembayaran.index')->with('success', 'Data jenis pembayaran berhasil diupdate.');
    }

    // Fungsi destroy untuk menghapus data jenis pembayaran
    public function destroy(JenisPembayaran $jenisPembayaran)
    {
        // Menghapus data jenis pembayaran
        $jenisPembayaran->delete();
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('jenis_pembayaran.index')->with('success', 'Data jenis pembayaran berhasil dihapus.');
    }
}
