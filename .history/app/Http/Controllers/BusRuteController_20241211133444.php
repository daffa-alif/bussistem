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
        $buses = Bus::all();  // Fetch all buses
        $rutes = Rute::all();  // Fetch all rutes
        return view('bus_rute.create', compact('buses', 'rutes'));
    }

    public function store(Request $request)
    {
        // Validate the selected options (id_bus and id_rute)
        $request->validate([
            'id_bus' => 'required|exists:bus,id_bus',  // Ensure id_bus exists in the bus table
            'id_rute' => 'required|exists:rute,id_rute',  // Ensure id_rute exists in the rute table
        ], [
            'id_bus.required' => 'Please select a bus.',
            'id_rute.required' => 'Please select a route.',
            'id_bus.exists' => 'The selected bus does not exist.',
            'id_rute.exists' => 'The selected route does not exist.',
        ]);

        // Check if the id_bus and id_rute combination already exists
        $exists = BusRute::where('id_bus', $request->id_bus)
            ->where('id_rute', $request->id_rute)
            ->exists();

        if ($exists) {
            return redirect()->route('bus_rute.create')->withErrors(['duplicate' => 'This Bus and Route combination already exists.']);
        }

        // Create the new BusRute entry with the selected id_bus and id_rute
        BusRute::create([
            'id_bus' => $request->id_bus,
            'id_rute' => $request->id_rute,
        ]);

        return redirect()->route('bus_rute.index')->with('success', 'Bus Route created successfully!');
    }

    public function edit($id)
    {
        $busRute = BusRute::findOrFail($id);  // Find the existing BusRute entry
        $buses = Bus::all();  // Fetch all buses
        $rutes = Rute::all();  // Fetch all rutes
        return view('bus_rute.edit', compact('busRute', 'buses', 'rutes'));
    }

    public function update(Request $request, $id)
    {
        // Validate the selected options (id_bus and id_rute)
        $request->validate([
            'id_bus' => 'required|exists:bus,id_bus',  // Ensure id_bus exists in the bus table
            'id_rute' => 'required|exists:rute,id_rute',  // Ensure id_rute exists in the rute table
        ], [
            'id_bus.required' => 'Please select a bus.',
            'id_rute.required' => 'Please select a route.',
            'id_bus.exists' => 'The selected bus does not exist.',
            'id_rute.exists' => 'The selected route does not exist.',
        ]);

        // Check if the id_bus and id_rute combination already exists (except for the current one)
        $exists = BusRute::where('id_bus', $request->id_bus)
            ->where('id_rute', $request->id_rute)
            ->where('id', '<>', $id)  // Exclude the current record
            ->exists();

        if ($exists) {
            return redirect()->route('bus_rute.edit', $id)->withErrors(['duplicate' => 'This Bus and Route combination already exists.']);
        }

        // Update the BusRute entry with the selected id_bus and id_rute
        $busRute = BusRute::findOrFail($id);
        $busRute->update([
            'id_bus' => $request->id_bus,
            'id_rute' => $request->id_rute,
        ]);

        return redirect()->route('bus_rute.index')->with('success', 'Bus Route updated successfully!');
    }

    public function destroy($id)
    {
        $busRute = BusRute::findOrFail($id);
        $busRute->delete();
        return redirect()->route('bus_rute.index')->with('success', 'Bus Route deleted successfully!');
    }
}
