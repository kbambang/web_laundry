<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OfficerController extends Controller
{
    public function index()
    {
        $officers = User::where('role', 'petugas')->get(); // Mengambil semua petugas
        return view('officers.index', compact('officers'));
    }

    public function create()
    {
        return view('officers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'petugas',  // Menetapkan role sebagai petugas
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('officers.index')->with('success', 'Petugas berhasil ditambahkan');
    }

    public function edit(User $officer)
    {
        return view('officers.edit', compact('officer'));
    }

    public function update(Request $request, User $officer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $officer->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $officer->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $officer->password,
        ]);

        return redirect()->route('officers.index')->with('success', 'Data petugas berhasil diperbarui');
    }

    public function destroy(User $officer)
    {
        $officer->delete();
        return redirect()->route('officers.index')->with('success', 'Petugas berhasil dihapus');
    }
}

