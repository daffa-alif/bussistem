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
            'bus_id' => 'required|exists:buses,id',
            'rute_id' => 'required|exists:rute,id_rute',
        ]);

        BusRute::create($request->all());
        return redirect()->route('bus_rute.index')->with('success', 'Bus Rute created successfully!');
    }

    public function edit($id)
    {
        $busRute = BusRute::findOrFail($id);
        $buses = Bus::all();
        $rutes = Rute::all();
        return view('bus_rute.edit', compact('busRute', 'buses', 'rutes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'rute_id' => 'required|exists:rute,id_rute',
        ]);

        $busRute = BusRute::findOrFail($id);
        $busRute->update($request->all());
        return redirect()->route('bus_rute.index')->with('success', 'Bus Rute updated successfully!');
    }

    public function destroy($id)
    {
        $busRute = BusRute::findOrFail($id);
        $busRute->delete();
        return redirect()->route('bus_rute.index')->with('success', 'Bus Rute deleted successfully!');
    }
}
