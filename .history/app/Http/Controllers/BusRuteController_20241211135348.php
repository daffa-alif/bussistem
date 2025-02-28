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
            'bus_id' => 'required|exists:buses,id',
            'rute_id' => 'required|exists:rute,id_rute',
        ]);

        // Ensure unique combinations of bus_id and rute_id
        $exists = BusRute::where('bus_id', $request->bus_id)
            ->where('rute_id', $request->rute_id)
            ->exists();

        if ($exists) {
            return redirect()->route('bus_rute.create')->withErrors(['duplicate' => 'This Bus and Rute combination already exists.']);
        }

        BusRute::create($request->all());

        return redirect()->route('bus_rute.index')->with('success', 'Bus Rute created successfully!');
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
