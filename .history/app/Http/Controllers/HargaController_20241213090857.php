<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use App\Models\Rute;
use App\Models\Kelas;
use Illuminate\Http\Request;

class HargaController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $harga = Harga::with('rute', 'kelas')->get(); // Eager load the relationships
        return view('harga.index', compact('harga'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        $rutes = Rute::all();
        $kelas = Kelas::all();
        return view('harga.create', compact('rutes', 'kelas'));
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $request->validate([
            'id_rute' => 'required|exists:rute,id_rute',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'harga' => 'required|numeric|min:0',
        ]);

        Harga::create([
            'id_rute' => $request->id_rute,
            'id_kelas' => $request->id_kelas,
            'harga' => $request->harga,
        ]);

        return redirect()->route('harga.index')->with('success', 'Harga added successfully!');
    }

    // Show the form for editing the specified resource
    public function edit($id_harga)
    {
        $harga = Harga::findOrFail($id_harga);
        $rutes = Rute::all();
        $kelas = Kelas::all();
        return view('harga.edit', compact('harga', 'rutes', 'kelas'));
    }

    // Update the specified resource in storage
    public function update(Request $request, $id_harga)
    {
        $request->validate([
            'id_rute' => 'required|exists:rute,id_rute',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'harga' => 'required|numeric|min:0',
        ]);

        $harga = Harga::findOrFail($id_harga);
        $harga->update([
            'id_rute' => $request->id_rute,
            'id_kelas' => $request->id_kelas,
            'harga' => $request->harga,
        ]);

        return redirect()->route('harga.index')->with('success', 'Harga updated successfully!');
    }

    // Remove the specified resource from storage
    public function destroy($id_harga)
    {
        $harga = Harga::findOrFail($id_harga);
        $harga->delete();

        return redirect()->route('harga.index')->with('success', 'Harga deleted successfully!');
    }
}
