<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPemesanan;
use App\Models\Pemesanan;
use App\Models\KursiBus;
use App\Models\Harga;

class DetailPemesananController extends Controller
{
    public function index($id_pemesanan)
    {
        // Fetch Pemesanan by ID
        $pemesanan = Pemesanan::findOrFail($id_pemesanan);

        // Fetch all details for the Pemesanan
        $detailPemesanan = DetailPemesanan::where('id_pemesanan', $id_pemesanan)
                                          ->with('kursiBus')  // Eager load kursiBus
                                          ->get();

        return view('detail_pemesanan.index', compact('pemesanan', 'detailPemesanan'));
    }

    public function create($id_pemesanan)
{
    // Fetch the pemesanan with related jadwal and bus
    $pemesanan = Pemesanan::with('jadwal.bus')->findOrFail($id_pemesanan);

    // Get the bus ID
    $busId = $pemesanan->jadwal->bus->id_bus;

    // Fetch available seats for the bus
    $kursiBus = KursiBus::where('id_bus', $busId)
        ->where('status_kursi', 'available')
        ->get();

    return view('detail_pemesanan.create', compact('pemesanan', 'kursiBus'));
}


public function store(Request $request)
{
    // Validate the incoming request
    $validated = $request->validate([
        'id_jadwal' => 'required|exists:jadwal,id_jadwal',
        'status' => 'required|in:pending,confirmed,cancelled,booking',
        'id_kursi' => 'nullable|exists:kursi_bus,id_kursi',
        'id_pengguna' => 'nullable|exists:pengguna,id_pengguna',
    ]);

    // Retrieve the authenticated user if no id_pengguna is provided
    $user = $validated['id_pengguna'] ?? auth()->user()->id_pengguna;

    // Create a new Pemesanan record
    $pemesanan = Pemesanan::create([
        'id_pengguna' => $user,
        'id_jadwal' => $validated['id_jadwal'],
        'status' => $validated['status'],
        'tanggal_pemesanan' => now(),
    ]);

    // If kursi is selected, use its price for total_harga
    $totalHarga = null;
    if (!empty($request->id_kursi)) {
        $kursiBus = KursiBus::find($request->id_kursi);
        if ($kursiBus) {
            $kursiBus->status_kursi = 'booked';  // Mark the seat as booked
            $kursiBus->save();
            $totalHarga = $kursiBus->harga;  // Get the price of the selected seat
        }
    }

    // Redirect to the detail_pemesanan.create route with id_pemesanan and kursi data
    return redirect()->route('detail_pemesanan.create', [
        'id_pemesanan' => $pemesanan->id_pemesanan,
        'id_kursi' => $request->id_kursi,
        'total_harga' => $totalHarga
    ])->with('success', 'Pemesanan created successfully.');
}


   
    public function destroy($id)
    {
        // Find the DetailPemesanan record
        $detailPemesanan = DetailPemesanan::findOrFail($id);

        // Perform the delete
        $detailPemesanan->delete();

        // Redirect back with a success message
        return redirect()->route('detail_pemesanan.index', ['id_pemesanan' => $detailPemesanan->id_pemesanan])
                         ->with('success', 'Detail Pemesanan deleted successfully.');
    }
}
