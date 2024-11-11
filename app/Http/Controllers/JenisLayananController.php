<?php

// Deklarasi namespace untuk controller ini dalam folder App\Http\Controllers
namespace App\Http\Controllers;

// Mengimpor model JenisLayanan dari App\Models untuk digunakan dalam controller ini
use App\Models\JenisLayanan;
// Mengimpor Request dari Illuminate\Http untuk menangani data permintaan HTTP
use Illuminate\Http\Request;

// Mendefinisikan class JenisLayananController yang mengelola CRUD data jenis layanan
class JenisLayananController extends Controller
{
    // Fungsi index menampilkan daftar semua data jenis layanan
    public function index()
    {
        // Mengambil semua data dari model JenisLayanan
        $jenisLayanan = JenisLayanan::all();
        // Menghitung total data jenis layanan
        $totalJenisLayanan = $jenisLayanan->count(); 
        // Mengembalikan tampilan (view) 'jenis_layanan.index' dengan variabel $jenisLayanan
        return view('jenis_layanan.index', compact('jenisLayanan'));
    }

    // Fungsi create menampilkan form untuk menambahkan data jenis layanan baru
    public function create()
    {
        // Mengembalikan tampilan 'jenis_layanan.create'
        return view('jenis_layanan.create');
    }

    // Fungsi store menyimpan data baru jenis layanan yang dikirim dari form
    public function store(Request $request)
    {
        // Validasi data yang dikirim dari form
        $request->validate([
            'nama_layanan' => 'required',             // Field nama_layanan wajib diisi
            'paket_layanan' => 'required',            // Field paket_layanan wajib diisi
            'harga' => 'required|numeric',            // Field harga wajib diisi dan harus berupa angka
        ]);

        // Mengambil semua data dari request form dan menghapus format Rupiah pada field harga
        $data = $request->all();
        $data['harga'] = preg_replace('/[Rp\s.]/', '', $data['harga']); // Menghapus "Rp", spasi, dan titik pada harga

        // Membuat data baru jenis layanan menggunakan model JenisLayanan
        JenisLayanan::create($data);
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('jenis_layanan.index')->with('success', 'Data jenis layanan berhasil ditambahkan.');
    }

    // Fungsi show menampilkan detail satu data jenis layanan
    public function show(JenisLayanan $jenisLayanan)
    {
        // Mengembalikan tampilan 'jenis_layanan.show' dengan data $jenisLayanan
        return view('jenis_layanan.show', compact('jenisLayanan'));
    }

    // Fungsi edit menampilkan form untuk mengedit data jenis layanan
    public function edit(JenisLayanan $jenisLayanan)
    {
        // Mengembalikan tampilan 'jenis_layanan.edit' dengan data $jenisLayanan
        return view('jenis_layanan.edit', compact('jenisLayanan'));
    }

    // Fungsi update menyimpan perubahan data jenis layanan yang telah diedit
    public function update(Request $request, JenisLayanan $jenisLayanan)
    {
        // Validasi data yang dikirim dari form
        $request->validate([
            'nama_layanan' => 'required',
            'paket_layanan' => 'required',
            'harga' => 'required|numeric',
        ]);

        // Mengambil semua data dari request form dan menghapus format Rupiah pada field harga
        $data = $request->all();
        $data['harga'] = preg_replace('/[Rp\s.]/', '', $data['harga']); // Menghapus "Rp", spasi, dan titik pada harga

        // Mengupdate data jenis layanan dengan data baru
        $jenisLayanan->update($data);
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('jenis_layanan.index')->with('success', 'Data jenis layanan berhasil diupdate.');
    }

    // Fungsi destroy menghapus data jenis layanan
    public function destroy(JenisLayanan $jenisLayanan)
    {
        // Menghapus data jenis layanan
        $jenisLayanan->delete();
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('jenis_layanan.index')->with('success', 'Data jenis layanan berhasil dihapus.');
    }
}
