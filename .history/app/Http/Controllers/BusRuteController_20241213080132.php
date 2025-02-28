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
        $busRutes = BusRute::with('bus', 'rute')->get();
        return view('bus_rute.index', compact('busRutes'));
    }

    public function create()
    {
        $buses = Bus::all();
        $rutes = Rute::all();
        return view('bus_rute.create', compact('buses', 'rutes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_bus' => 'required|exists:bus,id_bus',
            'id_rute' => 'required|exists:rute,id_rute',
        ], [
            'id_bus.required' => 'Please select a bus.',
            'id_rute.required' => 'Please select a route.',
            'id_bus.exists' => 'The selected bus does not exist.',
            'id_rute.exists' => 'The selected route does not exist.',
        ]);

        $exists = BusRute::where('id_bus', $request->id_bus)
            ->where('id_rute', $request->id_rute)
            ->exists();

        if ($exists) {
            return redirect()->route('bus_rute.create')->withErrors(['duplicate' => 'This Bus and Route combination already exists.']);
        }

        BusRute::create([
            'id_bus' => $request->id_bus,
            'id_rute' => $request->id_rute,
        ]);

        return redirect()->route('bus_rute.index')->with('success', 'Bus Route created successfully!');
    }

    public function edit($id_bus_rute)
    {
        $busRute = BusRute::findOrFail($id_bus_rute);
        $buses = Bus::all();
        $rutes = Rute::all();
        return view('bus_rute.edit', compact('busRute', 'buses', 'rutes'));
    }

    public function update(Request $request, $id_bus_rute)
{
    dd($id_bus_rute); // Debug the parameter
}


    public function destroy($id_bus_rute)
    {
        $busRute = BusRute::findOrFail($id_bus_rute);
        $busRute->delete();

        return redirect()->route('bus_rute.index')->with('success', 'Bus Route deleted successfully!');
    }
}
