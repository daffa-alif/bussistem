<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Rute;
use App\Models\BusRute;
use Illuminate\Http\Request;

class BusRuteController extends Controller
{
    public function index()
    {
        $busRutes = BusRute::with('bus', 'rute')->get(); // Eager loading to reduce queries
        return view('bus_rute.index', compact('busRutes'));
    }

    public function create()
    {
        $buses = Bus::all(); // Get all buses
        $rutes = Rute::all(); // Get all routes
        return view('bus_rute.create', compact('buses', 'rutes'));
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_bus' => 'required|string|exists:buses,nama_bus',
        'tujuan' => 'required|string|exists:rute,tujuan',
    ]);

    // Find the corresponding IDs based on nama_bus and tujuan
    $bus = Bus::where('nama_bus', $request->nama_bus)->firstOrFail();
    $rute = Rute::where('tujuan', $request->tujuan)->firstOrFail();

    // Store the data with the resolved IDs
    BusRute::create([
        'bus_id' => $bus->id,
        'rute_id' => $rute->id,
    ]);

    return redirect()->route('bus_rute.index')->with('success', 'Bus Rute created successfully!');
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama_bus' => 'required|string|exists:buses,nama_bus',
        'tujuan' => 'required|string|exists:rute,tujuan',
    ]);

    // Find the corresponding IDs based on nama_bus and tujuan
    $bus = Bus::where('nama_bus', $request->nama_bus)->firstOrFail();
    $rute = Rute::where('tujuan', $request->tujuan)->firstOrFail();

    $busRute = BusRute::findOrFail($id);

    // Update the data with the resolved IDs
    $busRute->update([
        'bus_id' => $bus->id,
        'rute_id' => $rute->id,
    ]);

    return redirect()->route('bus_rute.index')->with('success', 'Bus Rute updated successfully!');
}


    public function edit($id)
    {
        $busRute = BusRute::findOrFail($id); // Find specific record
        $buses = Bus::all(); // Get all buses
        $rutes = Rute::all(); // Get all routes
        return view('bus_rute.edit', compact('busRute', 'buses', 'rutes'));
    }

   

    public function destroy($id)
    {
        try {
            $busRute = BusRute::findOrFail($id);
            $busRute->delete();
            return redirect()->route('bus_rute.index')->with('success', 'Bus Rute deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('bus_rute.index')->withErrors(['error' => 'Failed to delete Bus Rute.']);
        }
    }
}
