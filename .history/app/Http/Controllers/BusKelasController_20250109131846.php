<?php

namespace App\Http\Controllers;

use App\Models\BusKelas;
use Illuminate\Http\Request;

class BusKelasController extends Controller
{
    // Create a new BusKelas record
    public function create(Request $request)
    {
        // Validate the request data
        $request->validate([
            'id_bus' => 'required|exists:bus,id',  // Ensure the bus exists in the 'bus' table
            'id_kelas' => 'required|exists:kelas,id'  // Ensure the class exists in the 'kelas' table
        ]);

        // Create a new BusKelas record
        $busKelas = BusKelas::create([
            'id_bus' => $request->id_bus,
            'id_kelas' => $request->id_kelas,
        ]);

        return response()->json(['message' => 'BusKelas created successfully', 'data' => $busKelas], 201);
    }

    // Read all BusKelas records
    public function index()
    {
        $busKelas = BusKelas::with(['bus', 'kelas'])->get();

        return response()->json($busKelas);
    }

    // Delete a BusKelas record by id_bus and id_kelas
    public function destroy($id_bus, $id_kelas)
    {
        // Find the BusKelas record with the given bus and class ids
        $busKelas = BusKelas::where('id_bus', $id_bus)
                            ->where('id_kelas', $id_kelas)
                            ->first();

        if (!$busKelas) {
            return response()->json(['message' => 'BusKelas not found'], 404);
        }

        // Delete the record
        $busKelas->delete();

        return response()->json(['message' => 'BusKelas deleted successfully']);
    }
}
