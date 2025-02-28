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
        $busRutes = BusRute::with('bus', 'rute')->get(); // Eager loading bus and rute data
        return view('bus_rute.index', compact('busRutes'));
    }

    public function create()
    {
        $buses = Bus::all(); // Fetch all buses
        $rutes = Rute::all(); // Fetch all routes
        return view('bus_rute.create', compact('buses', 'rutes'));
    }

    public function store(Request $request)
    {
        // Validate the selected options (bus_id and rute_id)
        $request->validate([
            'bus_id' => 'required|exists:buses,id',  // Ensure bus_id exists in the buses table
            'rute_id' => 'required|exists:rute,id_rute',  // Ensure rute_id exists in the rute table
        ]);

        // Check if the bus_id and rute_id combination already exists
        $exists = BusRute::where('bus_id', $request->bus_id)
            ->where('rute_id', $request->rute_id)
            ->exists();

        if ($exists) {
            return redirect()->route('bus_rute.create')->withErrors(['duplicate' => 'This Bus and Rute combination already exists.']);
        }

        // Create the new BusRute entry with the selected bus_id and rute_id
        BusRute::create([
            'bus_id' => $request->bus_id,
            'rute_id' => $request->rute_id,
        ]);

        return redirect()->route('bus_rute.index')->with('success', 'Bus Rute created successfully!');
    }

    public function edit($id)
    {
        $busRute = BusRute::findOrFail($id);  // Find the existing BusRute entry
        $buses = Bus::all();  // Fetch all buses
        $rutes = Rute::all();  // Fetch all routes
        return view('bus_rute.edit', compact('busRute', 'buses', 'rutes'));
    }

    public function update(Request $request, $id)
    {
        // Validate the selected options (bus_id and rute_id)
        $request->validate([
            'bus_id' => 'required|exists:buses,id',  // Ensure bus_id exists in the buses table
            'rute_id' => 'required|exists:rute,id_rute',  // Ensure rute_id exists in the rute table
        ]);

        // Check if the bus_id and rute_id combination already exists (except for the current one)
        $exists = BusRute::where('bus_id', $request->bus_id)
            ->where('rute_id', $request->rute_id)
            ->where('id', '<>', $id)  // Exclude the current record
            ->exists();

        if ($exists) {
            return redirect()->route('bus_rute.edit', $id)->withErrors(['duplicate' => 'This Bus and Rute combination already exists.']);
        }

        // Update the BusRute entry with the selected bus_id and rute_id
        $busRute = BusRute::findOrFail($id);
        $busRute->update([
            'bus_id' => $request->bus_id,
            'rute_id' => $request->rute_id,
        ]);

        return redirect()->route('bus_rute.index')->with('success', 'Bus Rute updated successfully!');
    }

    public function destroy($id)
    {
        $busRute = BusRute::findOrFail($id);
        $busRute->delete();
        return redirect()->route('bus_rute.index')->with('success', 'Bus Rute deleted successfully!');
    }
}
