<?php 

// Menentukan namespace dari controller ini di dalam folder App\Http\Controllers
namespace App\Http\Controllers;

// Mengimpor model Konsumen dari App\Models untuk digunakan di controller ini
use App\Models\Konsumen;
// Mengimpor Request dari Illuminate\Http untuk menangani data permintaan HTTP
use Illuminate\Http\Request;

// Mendefinisikan class KonsumenController untuk mengelola CRUD data Konsumen
class KonsumenController extends Controller
{
    // Fungsi index untuk menampilkan daftar semua konsumen
    public function index()
    {
        // Mengambil semua data konsumen dari model Konsumen
        $konsumens = Konsumen::all();
        // Menghitung total jumlah konsumen
        $totalKonsumen = $konsumens->count(); // Hitung total konsumen
        // Mengembalikan view 'konsumens.index' dengan variabel $konsumens
        return view('konsumens.index', compact('konsumens'));
    }

    // Fungsi create untuk menampilkan form menambahkan data konsumen baru
    public function create()
    {
        // Mengembalikan tampilan 'konsumens.create'
        return view('konsumens.create');
    }

    // Fungsi store menyimpan data baru konsumen yang dikirim dari form
    public function store(Request $request)
    {
        // Validasi data yang dikirim dari form
        $request->validate([
            'nama' => 'required',                     // Nama wajib diisi
            'email' => 'required|email|unique:konsumens,email',  // Email wajib, harus valid, dan unik di tabel konsumens
            'no_hp' => 'required',                    // Nomor HP wajib diisi
        ]);

        // Membuat data konsumen baru menggunakan data dari form
        Konsumen::create($request->all());
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('konsumens.index')->with('success', 'Konsumen berhasil ditambahkan');
    }

    // Fungsi show untuk menampilkan detail satu konsumen
    public function show(Konsumen $konsumen)
    {
        // Mengembalikan tampilan 'konsumens.show' dengan data $konsumen
        return view('konsumens.show', compact('konsumen'));
    }

    // Fungsi edit untuk menampilkan form edit data konsumen
    public function edit(Konsumen $konsumen)
    {
        // Mengembalikan tampilan 'konsumens.edit' dengan data $konsumen
        return view('konsumens.edit', compact('konsumen'));
    }

    // Fungsi update menyimpan perubahan data konsumen yang telah diedit
    public function update(Request $request, Konsumen $konsumen)
    {
        // Validasi data yang dikirim dari form
        $request->validate([
            'nama' => 'required',                     // Nama wajib diisi
            'email' => 'required|email|unique:konsumens,email,' . $konsumen->id, // Email harus valid dan unik, kecuali untuk data yang sedang diedit
            'no_hp' => 'required',                    // Nomor HP wajib diisi
        ]);

        // Memperbarui data konsumen dengan data baru
        $konsumen->update($request->all());
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('konsumens.index')->with('success', 'Konsumen berhasil diupdate');
    }

    // Fungsi destroy untuk menghapus data konsumen
    public function destroy(Konsumen $konsumen)
    {
        // Menghapus data konsumen
        $konsumen->delete();
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('konsumens.index')->with('success', 'Konsumen berhasil dihapus');
    }
}
