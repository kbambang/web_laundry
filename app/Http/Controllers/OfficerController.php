<?php

namespace App\Http\Controllers;

use App\Models\Officer;
use Illuminate\Http\Request;

class OfficerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $officers = Officer::all();
        return view('officers.index', compact('officers'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('officers.create');
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $request->validate([
            'nama' => 'required',
            'position' => 'required',
            'email' => 'required|email|unique:officers',
            'phone' => 'nullable',
        ]);
    
        Officer::create($request->all());
    
        return redirect()->route('officers.index')
                        ->with('success', 'Officer created successfully.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $officer = Officer::findOrFail($id);
        return view('officers.show', compact('officer'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */public function edit($id)
{
    $officer = Officer::findOrFail($id);
    return view('officers.edit', compact('officer'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'position' => 'required',
            'email' => 'required|email|unique:officers,email,' . $id,
            'phone' => 'nullable',
        ]);
    
        $officer = Officer::findOrFail($id);
        $officer->update($request->all());
    
        return redirect()->route('officers.index')
                        ->with('success', 'Officer updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $officer = Officer::findOrFail($id);
        $officer->delete();
    
        return redirect()->route('officers.index')
                        ->with('success', 'Officer deleted successfully.');
    }
    
}
