<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Officer;
use App\Models\Konsumen;
use App\Models\JenisLayanan;
use Illuminate\Http\Request;
use App\Models\JenisPembayaran;

class OrderController extends Controller
{
    public function index(Request $request)
{
    // Ambil input pencarian dari request
    $search = $request->input('search');

    // Query dasar dengan relasi
    $query = Order::with(['konsumen', 'officer', 'jenisLayanan', 'jenisPembayaran']);

    // Jika ada input pencarian, tambahkan kondisi pencarian hanya pada kolom no_transaksi
    if ($search) {
        $query->where('no_transaksi', 'like', '%' . $search . '%');
    }

    // Jalankan query dan ambil hasil
    $orders = $query->get();

    // Kembalikan view dengan hasil pencarian
    return view('order.index', compact('orders', 'search'));
}


    public function create()
    {
        $konsumens = Konsumen::all();
        $officers = Officer::all();
        $jenisLayanan = JenisLayanan::all();
        $jenisPembayaran = JenisPembayaran::all();

        return view('order.create', compact('konsumens', 'officers', 'jenisLayanan', 'jenisPembayaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'konsumen_id' => 'required|exists:konsumens,id',
            'officer_id' => 'required|exists:officers,id',
            'jenis_layanan_id' => 'required|exists:jenis_layanan,id',
            'jenis_pembayaran_id' => 'required|exists:jenis_pembayaran,id',
            'jumlah' => 'required|in:1,2,3,4,5,6,7,8,9,10',
        ]);
    
        // Hitung total_harga
        $jenisLayanan = JenisLayanan::findOrFail($request->jenis_layanan_id);
        $totalHarga = ($request->jumlah * 10000) + $jenisLayanan->harga;
    
        // Gabungkan data request dengan nilai total_harga
        $data = $request->all();
        $data['no_transaksi'] = 'TRX' . time() . rand(1000, 9999); // Menambahkan no_transaksi
        $data['total_harga'] = $totalHarga; // Menambahkan total_harga
    
        // Simpan data order ke database
        Order::create($data);
    
        return redirect()->route('orders.index')->with('success', 'Order berhasil ditambahkan.');
    }
    

    

    public function show(Order $order)
    {
        return view('order.show', compact('order'));
    }

    

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'konsumen_id' => 'required|exists:konsumen,id',
            'officer_id' => 'required|exists:officer,id',
            'jenis_layanan_id' => 'required|exists:jenis_layanan,id',
            'jenis_pembayaran_id' => 'required|exists:jenis_pembayaran,id',
            'jumlah' => 'required|integer|min:1',
            'total_harga' => 'required|numeric',
        ]);

        $order->update($request->all());
        return redirect()->route('orders.index')->with('success', 'Order berhasil diupdate.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order berhasil dihapus.');
    }

    public function histori()
    {
        // Mengambil semua order yang statusnya sudah selesai atau belum
        $orders = Order::with(['konsumen', 'officer', 'jenisLayanan', 'jenisPembayaran'])
            ->where('status', 'completed')
            ->orWhere('status', 'pending')
            ->get();

        return view('order.histori', compact('orders'));
    }


    public function complete(Order $order)
    {
        // Cek jika status order belum selesai
        if ($order->status !== 'completed') {
            $order->status = 'completed';
            $order->save();
            return redirect()->route('orders.histori')->with('success', 'Order berhasil ditandai sebagai selesai.');
        }

        return redirect()->route('orders.histori')->with('error', 'Order sudah selesai.');
    }
}
