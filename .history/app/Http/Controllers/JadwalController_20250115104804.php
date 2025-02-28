<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\BusRute;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    // Display a listing of the jadwals.
    public function index()
    {
        // Eager load bus and rute relationships with jadwal
        $jadwals = Jadwal::with(['busRute.bus', 'busRute.rute'])->get();
        return view('jadwal.index', compact('jadwals'));
    }
    

    // Show the form for creating a new jadwal.
    // Show the form for creating a new jadwal.
    public function create()
    {
        // Get all bus_rute records, including their bus and rute relationships
        $busRutes = BusRute::with(['bus', 'rute'])->get();
    
        // Debugging the busRutes data (remove this in production)
        // dd($busRutes); 
    
        return view('jadwal.create', compact('busRutes'));
    }

    public function getKursiBus($id_jadwal)
{
    // Fetch the jadwal and bus related information
    $jadwal = Jadwal::with('busRute.bus.kursiBus')->findOrFail($id_jadwal);
    
    // Get the kursi_bus for the bus related to the selected jadwal
    $kursi = $jadwal->busRute->bus->kursiBus()->where('status', 'available')->get();
    
    return response()->json(['kursi' => $kursi]);
}

    



    // Store a newly created jadwal in the database.
    public function store(Request $request)
    {
        $request->validate([
            'id_bus_rute' => 'required|exists:bus_rute,id_bus_rute',
            'tanggal' => 'required|date',
            'waktu_berangkat' => 'required|date_format:H:i',
            'waktu_tiba' => 'required|date_format:H:i',
        ]);

        Jadwal::create($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal created successfully.');
    }

    // Show the form for editing the specified jadwal.
    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $busRutes = BusRute::all();
        return view('jadwal.edit', compact('jadwal', 'busRutes'));
    }

    // Update the specified jadwal in the database.
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_bus_rute' => 'required|exists:bus_rute,id_bus_rute',
            'tanggal' => 'required|date',
            'waktu_berangkat' => 'required|date_format:H:i',
            'waktu_tiba' => 'required|date_format:H:i',
        ]);

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal updated successfully.');
    }

    // Remove the specified jadwal from the database.
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal deleted successfully.');
    }
}
