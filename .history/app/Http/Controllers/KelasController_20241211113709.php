<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    // Display all classes
    public function index()
    {
        $kelas = Kelas::all();
        return view('kelas.index', compact('kelas'));
    }

    // Show the form to create a new class
    public function create()
    {
        return view('kelas.create');
    }

    // Store a new class
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:50',
        ]);

        Kelas::create($request->all());
        return redirect()->route('kelas.index')->with('success', 'Class created successfully!');
    }

    // Show the form to edit a class
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('kelas.edit', compact('kelas'));
    }

    // Update a class
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:50',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update($request->all());
        return redirect()->route('kelas.index')->with('success', 'Class updated successfully!');
    }

    // Delete a class
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        return redirect()->route('kelas.index')->with('success', 'Class deleted successfully!');
    }
}
