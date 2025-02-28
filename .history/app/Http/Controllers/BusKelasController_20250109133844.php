<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Kelas;
use App\Models\BusKelas;
use Illuminate\Http\Request;

class BusKelasController extends Controller
{
    // Display a listing of BusKelas
    public function index()
    {
        // Fetch all BusKelas records with related bus and kelas information
        $busKelas = BusKelas::with(['bus', 'kelas'])->get();

        // Return the index view located in resources/views/bus-kelas/index.blade.php
        return view('bus-kelas.index', compact('busKelas'));
    }

    // Show the form for creating a new BusKelas
    public function create()
    {
        // Get all buses and classes to populate the dropdowns
        $buses = Bus::all();  // Get all buses from the 'bus' table
        $classes = Kelas::all();  // Get all classes from the 'kelas' table

        // Return the create view located in resources/views/bus-kelas/create.blade.php
        return view('bus-kelas.create', compact('buses', 'classes'));
    }

    // Store a newly created BusKelas in the database
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'id_bus' => 'required|exists:bus,id_bus',  // Ensure the bus exists
            'id_kelas' => 'required|exists:kelas,id_kelas'  // Ensure the kelas exists
        ]);

        // Create the BusKelas record
        $busKelas = BusKelas::create([
            'id_bus' => $request->id_bus,
            'id_kelas' => $request->id_kelas,
        ]);

        // Redirect back to the index with a success message
        return redirect()->route('bus-kelas.index')->with('success', 'BusKelas created successfully!');
    }

    // Remove a BusKelas from the database
    public function destroy($id_bus, $id_kelas)
    {
        // Find the BusKelas record using both id_bus and id_kelas
        $busKelas = BusKelas::where('id_bus', $id_bus)
                            ->where('id_kelas', $id_kelas)
                            ->first();

        // If the record doesn't exist, return a 404 error
        if (!$busKelas) {
            return response()->json(['message' => 'BusKelas not found'], 404);
        }

        // Delete the BusKelas record
        $busKelas->delete();

        // Return a success response
        return redirect()->route('bus-kelas.index')->with('success', 'BusKelas deleted successfully!');
    }
}
