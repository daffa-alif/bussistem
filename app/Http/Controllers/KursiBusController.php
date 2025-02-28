<?php

namespace App\Http\Controllers;

use App\Models\KursiBus;
use App\Models\Bus;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KursiBusController extends Controller
{
    public function index()
    {
        $kursiBuses = KursiBus::all();
        return view('kursibus.index', compact('kursiBuses'));
    }

    public function create()
    {
        // Fetch all buses and kelas to display in the form
        $buses = Bus::all(); 
        $kelas = Kelas::all();

        return view('kursibus.create', compact('buses', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_bus' => 'required|exists:bus,id_bus',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'nomor_kursi' => 'required|string|max:10',
            'status_kursi' => 'required|in:available,booked',
        ]);

        KursiBus::create($request->all());

        return redirect()->route('kursibus.index')->with('success', 'Kursi bus created successfully!');
    }

    public function edit($id)
    {
        $kursiBus = KursiBus::findOrFail($id);

        // Fetch all buses and kelas
        $buses = Bus::all();
        $kelas = Kelas::all();

        return view('kursibus.edit', compact('kursiBus', 'buses', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_bus' => 'required|exists:bus,id_bus',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'nomor_kursi' => 'required|string|max:10',
            'status_kursi' => 'required|in:available,booked',
        ]);

        $kursiBus = KursiBus::findOrFail($id);
        $kursiBus->update($request->all());

        return redirect()->route('kursibus.index')->with('success', 'Kursi bus updated successfully!');
    }

    public function destroy($id)
    {
        $kursiBus = KursiBus::findOrFail($id);
        $kursiBus->delete();

        return redirect()->route('kursibus.index')->with('success', 'Kursi bus deleted successfully!');
    }
}
