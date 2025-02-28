<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Jadwal;
use App\Models\User;
use App\Models\KursiBus;

class PemesananController extends Controller
{
    public function index()
{
    // Fetch all pemesanan with related user and jadwal data
    $pemesanan = Pemesanan::with(['user', 'jadwal'])->get();

    // Fetch all jadwal data to pass to the view
    $jadwal = Jadwal::all();

    // Pass both pemesanan and jadwal to the view
    return view('pemesanan.index', compact('pemesanan', 'jadwal'));
}

    public function create()
{
    // Fetch all jadwal and select only the relevant columns (waktu_berangkat, waktu_tiba)
    $jadwal = Jadwal::all(['id_jadwal', 'waktu_berangkat', 'waktu_tiba']); 
 
    $kursi_bus = KursiBus::with(['bus', 'kelas'])->where('status_kursi', 'available')->get();
 
    return view('pemesanan.create', compact('jadwal', 'kursi_bus'));
}


    public function fetchDetailPemesanan($id_pemesanan)
{
    $detailPemesanan = DetailPemesanan::where('id_pemesanan', $id_pemesanan)->get();
    return response()->json($detailPemesanan);
}




public function store(Request $request)
{
    // Validate the incoming request
    $validated = $request->validate([
        'id_jadwal' => 'required|exists:jadwal,id_jadwal',  // Ensure the jadwal exists in the database
        'status' => 'required|in:pending,confirmed,cancelled,booking',  // Ensure valid status
        'id_kursi' => 'nullable|exists:kursi_bus,id_kursi',  // Ensure the kursi exists if provided
        'id_pengguna' => 'nullable|exists:users,id_pengguna', // Allow for manual user input, if blank, use authenticated user
    ]);

    // Retrieve the authenticated user if no id_pengguna is provided
    $user = $validated['id_pengguna'] ?? auth()->user()->id_pengguna;  // Default to authenticated user

    // Create a new Pemesanan record
    $pemesanan = Pemesanan::create([
        'id_pengguna' => $user,  // Use the selected or authenticated user
        'id_jadwal' => $validated['id_jadwal'],
        'status' => $validated['status'],
        'tanggal_pemesanan' => now(),  // Automatically set the current timestamp
    ]);

    // Update the KursiBus status if id_kursi is provided
    if (!empty($request->id_kursi)) {
        $kursiBus = KursiBus::find($request->id_kursi);
        if ($kursiBus) {
            $kursiBus->status_kursi = 'booked';  // Mark the seat as booked
            $kursiBus->save();
        }
    }

    // Redirect to the Pemesanan index page with a success message
    return redirect()->route('pemesanan.index')->with('success', 'Pemesanan created successfully.');
}

public function update(Request $request, $id)
{
    $request->validate([
        'id_pengguna' => 'nullable|exists:users,id_pengguna',  // Optional, ensure it's a valid user if provided
        'id_jadwal' => 'required|exists:jadwal,id_jadwal',
        'status' => 'required|in:pending,confirmed,cancelled,booking',
    ]);

    // Set the id_pengguna to the first user if not provided
    $user = $request->input('id_pengguna') ?? User::first()->id_pengguna;

    $pemesanan = Pemesanan::findOrFail($id);
    $pemesanan->update($request->only(['id_jadwal', 'status']) + ['id_pengguna' => $user]);

    return redirect()->route('pemesanan.index')->with('success', 'Pemesanan updated successfully.');
}

    

    public function edit($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $jadwal = Jadwal::all();
        $users = User::all();
        return view('pemesanan.edit', compact('pemesanan', 'jadwal', 'users'));
    }

    

    public function destroy($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->delete();

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan deleted successfully.');
    }
}
