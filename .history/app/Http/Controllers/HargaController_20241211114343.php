<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use App\Models\Rute;
use App\Models\Kelas;
use Illuminate\Http\Request;

class HargaController extends Controller
{
    public function index()
    {
        $hargas = Harga::all();
        return view('harga.index', compact('hargas'));
    }

    public function create()
    {
        $rutes = Rute::all();
        $kelas = Kelas::all();
        return view('harga.create', compact('rutes', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_rute' => 'required|exists:rute,id_rute',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'harga' => 'required|numeric',
        ]);

        Harga::create($request->all());
        return redirect()->route('harga.index')->with('success', 'Price created successfully!');
    }

    public function edit($id)
    {
        $harga = Harga::findOrFail($id);
        $rutes = Rute::all();
        $kelas = Kelas::all();
        return view('harga.edit', compact('harga', 'rutes', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_rute' => 'required|exists:rute,id_rute',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'harga' => 'required|numeric',
        ]);

        $harga = Harga::findOrFail($id);
        $harga->update($request->all());
        return redirect()->route('harga.index')->with('success', 'Price updated successfully!');
    }

    public function destroy($id)
    {
        $harga = Harga::findOrFail($id);
        $harga->delete();
        return redirect()->route('harga.index')->with('success', 'Price deleted successfully!');
    }
}
