<?php

namespace App\Http\Controllers;

use App\Models\JenisPembayaran;
use Illuminate\Http\Request;

class JenisPembayaranController extends Controller
{
    public function index()
    {
        $jenisPembayaran = JenisPembayaran::all();
        return view('jenis_pembayaran.index', compact('jenisPembayaran'));
    }

    public function create()
    {
        return view('jenis_pembayaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pembayaran' => 'required',
        ]);

        JenisPembayaran::create($request->all());
        return redirect()->route('jenis_pembayaran.index')->with('success', 'Data jenis pembayaran berhasil ditambahkan.');
    }

    public function show(JenisPembayaran $jenisPembayaran)
    {
        return view('jenis_pembayaran.show', compact('jenisPembayaran'));
    }

    public function edit(JenisPembayaran $jenisPembayaran)
    {
        return view('jenis_pembayaran.edit', compact('jenisPembayaran'));
    }

    public function update(Request $request, JenisPembayaran $jenisPembayaran)
    {
        $request->validate([
            'nama_pembayaran' => 'required',
        ]);

        $jenisPembayaran->update($request->all());
        return redirect()->route('jenis_pembayaran.index')->with('success', 'Data jenis pembayaran berhasil diupdate.');
    }

    public function destroy(JenisPembayaran $jenisPembayaran)
    {
        $jenisPembayaran->delete();
        return redirect()->route('jenis_pembayaran.index')->with('success', 'Data jenis pembayaran berhasil dihapus.');
    }
}
