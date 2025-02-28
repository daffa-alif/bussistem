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
        // Eager load 'bus' and 'rute' relationships
        $busRutes = BusRute::with('bus', 'rute')->get();
        return view('bus_rute.index', compact('busRutes'));
    }

    public function create()
    {
        // Fetch all buses and rutes for the create form
        $buses = Bus::all();
        $rutes = Rute::all();
        return view('bus_rute.create', compact('buses', 'rutes'));
    }

    public function store(Request $request)
    {
        // Validate the selected bus (id_bus) and route (id_rute)
        $request->validate([
            'id_bus' => 'required|exists:bus,id_bus',  // Ensure id_bus exists in the bus table
            'id_rute' => 'required|exists:rute,id_rute',  // Ensure id_rute exists in the rute table
        ], [
            'id_bus.required' => 'Please select a bus.',
            'id_rute.required' => 'Please select a route.',
            'id_bus.exists' => 'The selected bus does not exist.',
            'id_rute.exists' => 'The selected route does not exist.',
        ]);

        // Check if the bus and route combination already exists in the bus_rutes table
        $exists = BusRute::where('id_bus', $request->id_bus)
            ->where('id_rute', $request->id_rute)
            ->exists();

        if ($exists) {
            // Redirect back with an error message if the combination exists
            return redirect()->route('bus_rute.create')->withErrors(['duplicate' => 'This Bus and Route combination already exists.']);
        }

        // Create a new bus_route entry
        BusRute::create([
            'id_bus' => $request->id_bus,
            'id_rute' => $request->id_rute,
        ]);

        return redirect()->route('bus_rute.index')->with('success', 'Bus Route created successfully!');
    }

    public function edit($id_bus_rute)
    {
        // Find the bus route by ID or fail
        $busRute = BusRute::findOrFail($id_bus_rute);

        // Get all buses and routes for dropdown selection
        $buses = Bus::all();
        $rutes = Rute::all();

        // Return the edit view with bus route, buses, and routes
        return view('bus_rute.edit', compact('busRute', 'buses', 'rutes'));
    }

    // Handle the update logic
    public function update(Request $request, $id_bus_rute)
    {
        // Validate the input
        $request->validate([
            'id_bus' => 'required|exists:bus,id_bus',
            'id_rute' => 'required|exists:rute,id_rute',
        ]);

        // Check if the combination already exists (excluding the current one)
        $exists = BusRute::where('id_bus', $request->id_bus)
            ->where('id_rute', $request->id_rute)
            ->where('id_bus_rute', '<>', $id_bus_rute)  // Exclude the current record
            ->exists();

        if ($exists) {
            return redirect()->route('bus_rute.edit', $id_bus_rute)->withErrors(['duplicate' => 'This Bus and Route combination already exists.']);
        }

        // Find the bus route and update it
        $busRute = BusRute::findOrFail($id_bus_rute);
        $busRute->update([
            'id_bus' => $request->id_bus,
            'id_rute' => $request->id_rute,
        ]);

        // Redirect to the bus route index with a success message
        return redirect()->route('bus_rute.index')->with('success', 'Bus Route updated successfully!');
    }

    public function destroy($id_bus_rute)
    {
        $busRute = BusRute::findOrFail($id_bus_rute);
        $busRute->delete();

        return redirect()->route('bus_rute.index')->with('success', 'Bus Route deleted successfully!');
    }
}
