<?php

namespace App\Http\Controllers;

use App\Models\BusRute;
use App\Models\Bus;
use App\Models\Rute;
use Illuminate\Http\Request;

class BusRuteController extends Controller
{
    public function index()
    {
        $busRutes = BusRute::all();
        return view('bus-rute.index', compact('busRutes'));
    }

    public function create()
    {
        $buses = Bus::all();
        $rutes = Rute::all();
        return view('bus-rute.create', compact('buses', 'rutes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_bus' => 'required|exists:bus,id_bus',
            'id_rute' => 'required|exists:rute,id_rute',
        ]);

        BusRute::create($request->all());
        return redirect()->route('bus-rute.index')->with('success', 'Bus route created successfully!');
    }

    public function edit($id)
    {
        $busRute = BusRute::findOrFail($id);
        $buses = Bus::all();
        $rutes = Rute::all();
        return view('bus-rute.edit', compact('busRute', 'buses', 'rutes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_bus' => 'required|exists:bus,id_bus',
            'id_rute' => 'required|exists:rute,id_rute',
        ]);

        $busRute = BusRute::findOrFail($id);
        $busRute->update($request->all());
        return redirect()->route('bus-rute.index')->with('success', 'Bus route updated successfully!');
    }

    public function destroy($id)
    {
        $busRute = BusRute::findOrFail($id);
        $busRute->delete();
        return redirect()->route('bus-rute.index')->with('success', 'Bus route deleted successfully!');
    }
}
