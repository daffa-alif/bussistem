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
        return view('pemesanan.index', compact('pemesanan'));
    }

    public function create()
    {
        $jadwal = Jadwal::all(); // Retrieve all rows from the 'jadwal' table
        return view('pemesanan.create', compact('jadwal'));
        $kursi_bus = KursiBus::with(['bus', 'kelas'])->where('status_kursi', 'available')->get();
        return view('pemesanan.create', compact('jadwal', 'kursi_bus'));
    }

    public function store(Request $request)
    {
        
        // Validate the incoming request
        $validated = $request->validate([
            'id_jadwal' => 'required|exists:jadwal,id_jadwal',  // Ensure the jadwal exists in the database
            'status' => 'required|in:pending,confirmed,cancelled,booking',  // Ensure valid status
            'id_kursi' => 'nullable|exists:kursi_bus,id_kursi',  // Ensure the kursi exists if provided
        ]);
    
        // Retrieve the authenticated user
        $user = auth()->user();  // Automatically fetch the authenticated user
    
        // Create a new Pemesanan record
        $pemesanan = Pemesanan::create([
            'id_pengguna' => $user->id_pengguna,  // Reference the authenticated user's ID
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
    

    public function edit($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $jadwal = Jadwal::all();
        $users = User::all();
        return view('pemesanan.edit', compact('pemesanan', 'jadwal', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pengguna' => 'required|exists:users,id_pengguna',
            'id_jadwal' => 'required|exists:jadwal,id_jadwal',
            'status' => 'required|in:pending,confirmed,cancelled,booking',
        ]);

        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->update($request->only(['id_pengguna', 'id_jadwal', 'status']));

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan updated successfully.');
    }

    public function destroy($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->delete();

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan deleted successfully.');
    }
}
