<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function index()
    {
        $buses = Bus::all();
        return view('bus.index', compact('buses'));
    }

    public function create()
    {
        return view('bus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_bus' => 'required|string|max:100',
            'plat_nomor' => 'required|string|max:20',
            'kapasitas' => 'required|integer',
        ]);

        Bus::create($request->all());
        return redirect()->route('bus.index')->with('success', 'Bus created successfully!');
    }

    public function edit($id)
    {
        $bus = Bus::findOrFail($id);
        return view('bus.edit', compact('bus'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_bus' => 'required|string|max:100',
            'plat_nomor' => 'required|string|max:20',
            'kapasitas' => 'required|integer',
        ]);

        $bus = Bus::findOrFail($id);
        $bus->update($request->all());
        return redirect()->route('bus.index')->with('success', 'Bus updated successfully!');
    }

    public function destroy($id)
    {
        $bus = Bus::findOrFail($id);
        $bus->delete();
        return redirect()->route('bus.index')->with('success', 'Bus deleted successfully!');
    }
}
