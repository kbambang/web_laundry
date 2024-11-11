<?php

namespace App\Http\Controllers;

// Mengimpor model dan package yang dibutuhkan
use App\Models\Order;
use App\Models\Konsumen;
use App\Models\JenisLayanan;
use Illuminate\Http\Request;
use App\Models\JenisPembayaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanTransaksiExport;

// Definisi class LaporanController untuk mengelola laporan transaksi
class LaporanController extends Controller
{
    // Fungsi index untuk menampilkan laporan transaksi
    public function index(Request $request)
    {
        // Mendapatkan data transaksi (orders) dari model Order dan relasi terkait
        $orders = Order::with(['konsumen', 'jenisLayanan', 'jenisPembayaran'])
            // Memfilter data berdasarkan tanggal mulai (start_date) jika ada
            ->when($request->start_date, function ($query) use ($request) {
                return $query->whereDate('created_at', '>=', $request->start_date);
            })
            // Memfilter data berdasarkan tanggal akhir (end_date) jika ada
            ->when($request->end_date, function ($query) use ($request) {
                return $query->whereDate('created_at', '<=', $request->end_date);
            })
            // Mendapatkan semua data yang sesuai
            ->get();

        // Menghitung total pendapatan dari semua transaksi yang diambil
        $totalPendapatan = $orders->sum('total_harga');

        // Mengirim data 'orders' dan 'totalPendapatan' ke view laporan.transaksi
        return view('laporan.transaksi', compact('orders', 'totalPendapatan'));
    }

    // Fungsi untuk mengekspor laporan transaksi ke dalam format PDF
    public function exportPdf(Request $request)
    {
        // Mengambil data transaksi (orders) dengan filter berdasarkan tanggal jika ada
        $orders = Order::with(['konsumen', 'jenisLayanan', 'jenisPembayaran'])
            ->when($request->start_date, function ($query) use ($request) {
                return $query->whereDate('created_at', '>=', $request->start_date);
            })
            ->when($request->end_date, function ($query) use ($request) {
                return $query->whereDate('created_at', '<=', $request->end_date);
            })
            ->get();

        // Menghitung total pendapatan dari transaksi yang diambil
        $totalPendapatan = $orders->sum('total_harga');

        // Membuat PDF dengan tampilan dari view laporan.pdf dan data 'orders' serta 'totalPendapatan'
        $pdf = Pdf::loadView('laporan.pdf', compact('orders', 'totalPendapatan'));

        // Mendownload file PDF dengan nama 'laporan_transaksi.pdf'
        return $pdf->download('laporan_transaksi.pdf');
    }
}
