<?php

namespace App\Http\Controllers;

use App\Models\BusKelas;
use App\Models\Bus;
use App\Models\Kelas;
use Illuminate\Http\Request;

class BusKelasController extends Controller
{
    public function index()
    {
        $busKelas = BusKelas::all();
        return view('bus-kelas.index', compact('busKelas'));
    }

    public function create()
    {
        $buses = Bus::all();
        $kelas = Kelas::all();
        return view('bus-kelas.create', compact('buses', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_bus' => 'required|exists:bus,id_bus',
            'id_kelas' => 'required|exists:kelas,id_kelas',
        ]);

        BusKelas::create($request->all());
        return redirect()->route('bus-kelas.index')->with('success', 'Bus class created successfully!');
    }

    public function edit($id)
    {
        $busKelas = BusKelas::findOrFail($id);
        $buses = Bus::all();
        $kelas = Kelas::all();
        return view('bus-kelas.edit', compact('busKelas', 'buses', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_bus' => 'required|exists:bus,id_bus',
            'id_kelas' => 'required|exists:kelas,id_kelas',
        ]);

        $busKelas = BusKelas::findOrFail($id);
        $busKelas->update($request->all());
        return redirect()->route('bus-kelas.index')->with('success', 'Bus class updated successfully!');
    }

    public function destroy($id)
    {
        $busKelas = BusKelas::findOrFail($id);
        $busKelas->delete();
        return redirect()->route('bus-kelas.index')->with('success', 'Bus class deleted successfully!');
    }
}
