<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Konsumen;
use App\Models\JenisLayanan;
use Illuminate\Http\Request;
use App\Models\JenisPembayaran;

class OrderController extends Controller
{
    // Fungsi index untuk menampilkan daftar pesanan dengan fitur pencarian berdasarkan nomor transaksi
    public function index(Request $request)
    {
        $search = $request->input('search'); // Mengambil input pencarian
        $query = Order::with(['konsumen', 'jenisLayanan', 'jenisPembayaran']); // Query dasar dengan relasi

        // Jika ada input pencarian, tambahkan kondisi pencarian pada kolom no_transaksi
        if ($search) {
            $query->where('no_transaksi', 'like', '%' . $search . '%');
        }

        $orders = $query->get(); // Menjalankan query dan mendapatkan hasil
        return view('order.index', compact('orders', 'search')); // Mengirim data ke view
    }

    // Fungsi create untuk menampilkan form penambahan pesanan
    public function create()
    {
        // Mengambil data konsumens, jenis layanan, dan jenis pembayaran untuk pilihan form
        $konsumens = Konsumen::all();
        $jenisLayanan = JenisLayanan::all();
        $jenisPembayaran = JenisPembayaran::all();

        return view('order.create', compact('konsumens', 'jenisLayanan', 'jenisPembayaran'));
    }

    // Fungsi store untuk menyimpan data pesanan baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'konsumen_id' => 'required|exists:konsumens,id',
            'jenis_layanan_id' => 'required|exists:jenis_layanan,id',
            'jenis_pembayaran_id' => 'required|exists:jenis_pembayaran,id',
            'jumlah' => 'required|in:1,2,3,4,5,6,7,8,9,10',
        ]);

        // Menghitung total_harga berdasarkan jumlah dan harga layanan
        $jenisLayanan = JenisLayanan::findOrFail($request->jenis_layanan_id);
        $totalHarga = ($request->jumlah * 10000) + $jenisLayanan->harga;

        // Menambahkan data tambahan ke dalam request, yaitu no_transaksi dan total_harga
        $data = $request->all();
        $data['no_transaksi'] = 'TRX' . time() . rand(1000, 9999); // Nomor transaksi unik
        $data['total_harga'] = $totalHarga;

        // Simpan data pesanan ke database
        Order::create($data);
        return redirect()->route('orders.index')->with('success', 'Order berhasil ditambahkan.');
    }

    // Fungsi show untuk menampilkan detail pesanan
    public function show(Order $order)
    {
        return view('order.show', compact('order'));
    }

    // Fungsi update untuk memperbarui data pesanan
    public function update(Request $request, Order $order)
    {
        // Validasi input data
        $request->validate([
            'konsumen_id' => 'required|exists:konsumen,id',
            'jenis_layanan_id' => 'required|exists:jenis_layanan,id',
            'jenis_pembayaran_id' => 'required|exists:jenis_pembayaran,id',
            'jumlah' => 'required|integer|min:1',
            'total_harga' => 'required|numeric',
        ]);

        // Update data pesanan di database
        $order->update($request->all());
        return redirect()->route('orders.index')->with('success', 'Order berhasil diupdate.');
    }

    // Fungsi destroy untuk menghapus pesanan
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order berhasil dihapus.');
    }

    // Fungsi histori untuk menampilkan riwayat pesanan yang sudah selesai atau belum
    public function histori()
    {
        // Mengambil semua pesanan yang berstatus completed atau pending
        $orders = Order::with(['konsumen', 'jenisLayanan', 'jenisPembayaran'])
            ->where('status', 'completed')
            ->orWhere('status', 'pending')
            ->get();

        return view('order.histori', compact('orders'));
    }

    // Fungsi complete untuk menandai pesanan sebagai selesai
    public function complete(Order $order)
    {
        // Cek jika status pesanan belum completed
        if ($order->status !== 'completed') {
            $order->status = 'completed';
            $order->save();
            return redirect()->route('orders.histori')->with('success', 'Order berhasil ditandai sebagai selesai.');
        }

        return redirect()->route('orders.histori')->with('error', 'Order sudah selesai.');
    }
}
