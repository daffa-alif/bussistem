<?php

namespace App\Http\Controllers;

use App\Models\Rute;
use Illuminate\Http\Request;

class RuteController extends Controller
{
    public function index()
    {
        $rute = Rute::all();
        return view('rute.index', compact('rute'));
    }

    public function create()
    {
        return view('rute.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'asal' => 'required|string|max:100',
            'tujuan' => 'required|string|max:100',
            'jarak_km' => 'required|numeric|min:0',
        ]);

        Rute::create($request->all());
        return redirect()->route('rute.index')->with('success', 'Rute created successfully!');
    }

    public function edit($id)
    {
        $rute = Rute::findOrFail($id);
        return view('rute.edit', compact('rute'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'asal' => 'required|string|max:100',
            'tujuan' => 'required|string|max:100',
            'jarak_km' => 'required|numeric|min:0',
        ]);

        $rute = Rute::findOrFail($id);
        $rute->update($request->all());
        return redirect()->route('rute.index')->with('success', 'Rute updated successfully!');
    }

    public function destroy($id)
    {
        $rute = Rute::findOrFail($id);
        $rute->delete();
        return redirect()->route('rute.index')->with('success', 'Rute deleted successfully!');
    }
}
