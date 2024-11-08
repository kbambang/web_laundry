<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Officer;
use App\Models\Konsumen;
use App\Models\JenisLayanan;
use Illuminate\Http\Request;
use App\Models\JenisPembayaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanTransaksiExport;

class LaporanController extends Controller
{
    // Menampilkan laporan transaksi
    public function index(Request $request)
    {
        // Menyaring berdasarkan tanggal jika ada
        $orders = Order::with(['konsumen', 'officer', 'jenisLayanan', 'jenisPembayaran'])
            ->when($request->start_date, function ($query) use ($request) {
                return $query->whereDate('created_at', '>=', $request->start_date);
            })
            ->when($request->end_date, function ($query) use ($request) {
                return $query->whereDate('created_at', '<=', $request->end_date);
            })
            ->get();

        // Hitung total pendapatan dari semua transaksi
        $totalPendapatan = $orders->sum('total_harga');

        // Kirimkan data orders dan totalPendapatan ke view
        return view('laporan.transaksi', compact('orders', 'totalPendapatan'));
    }

    // // Fungsi untuk export ke PDF
    public function exportPdf(Request $request)
    {
        // Menyaring berdasarkan tanggal jika ada
        $orders = Order::with(['konsumen', 'officer', 'jenisLayanan', 'jenisPembayaran'])
            ->when($request->start_date, function ($query) use ($request) {
                return $query->whereDate('created_at', '>=', $request->start_date);
            })
            ->when($request->end_date, function ($query) use ($request) {
                return $query->whereDate('created_at', '<=', $request->end_date);
            })
            ->get();

        // Hitung total pendapatan dari semua transaksi
        $totalPendapatan = $orders->sum('total_harga');

        // Load view dan generate PDF
        $pdf = Pdf::loadView('laporan.pdf', compact('orders', 'totalPendapatan'));

        // Download file PDF
        return $pdf->download('laporan_transaksi.pdf');
    }
}
