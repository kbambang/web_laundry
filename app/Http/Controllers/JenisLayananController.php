<?php

namespace App\Http\Controllers;

use App\Models\JenisLayanan;
use Illuminate\Http\Request;

class JenisLayananController extends Controller
{
    public function index()
    {
        $jenisLayanan = JenisLayanan::all();
        return view('jenis_layanan.index', compact('jenisLayanan'));
    }

    public function create()
    {
        return view('jenis_layanan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required',
            'paket_layanan' => 'required',
            'harga' => 'required|numeric',
        ]);

        JenisLayanan::create($request->all());
        return redirect()->route('jenis_layanan.index')->with('success', 'Data jenis layanan berhasil ditambahkan.');
    }

    public function show(JenisLayanan $jenisLayanan)
    {
        return view('jenis_layanan.show', compact('jenisLayanan'));
    }

    public function edit(JenisLayanan $jenisLayanan)
    {
        return view('jenis_layanan.edit', compact('jenisLayanan'));
    }

    public function update(Request $request, JenisLayanan $jenisLayanan)
    {
        $request->validate([
            'nama_layanan' => 'required',
            'paket_layanan' => 'required',
            'harga' => 'required|numeric',
        ]);

        $jenisLayanan->update($request->all());
        return redirect()->route('jenis_layanan.index')->with('success', 'Data jenis layanan berhasil diupdate.');
    }

    public function destroy(JenisLayanan $jenisLayanan)
    {
        $jenisLayanan->delete();
        return redirect()->route('jenis_layanan.index')->with('success', 'Data jenis layanan berhasil dihapus.');
    }
}
