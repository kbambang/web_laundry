<?php 

namespace App\Http\Controllers;

use App\Models\Konsumen;
use Illuminate\Http\Request;

class KonsumenController extends Controller
{
    public function index()
    {
        $konsumens = Konsumen::all();
        return view('konsumens.index', compact('konsumens'));
    }

    public function create()
    {
        return view('konsumens.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:konsumens,email',
            'no_hp' => 'required',
        ]);

        Konsumen::create($request->all());
        return redirect()->route('konsumens.index')->with('success', 'Konsumen berhasil ditambahkan');
    }

    public function show(Konsumen $konsumen)
    {
        return view('konsumens.show', compact('konsumen'));
    }

    public function edit(Konsumen $konsumen)
    {
        return view('konsumens.edit', compact('konsumen'));
    }

    public function update(Request $request, Konsumen $konsumen)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:konsumens,email,' . $konsumen->id,
            'no_hp' => 'required',
        ]);

        $konsumen->update($request->all());
        return redirect()->route('konsumens.index')->with('success', 'Konsumen berhasil diupdate');
    }

    public function destroy(Konsumen $konsumen)
    {
        $konsumen->delete();
        return redirect()->route('konsumens.index')->with('success', 'Konsumen berhasil dihapus');
    }
}
