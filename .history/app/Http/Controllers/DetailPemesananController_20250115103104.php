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


public function store(Request $request, $id_pemesanan)
{
    // Validate incoming request
    $validated = $request->validate([
        'id_kursi_bus' => 'required|exists:kursi_bus,id_kursi',
        'nama_penumpang' => 'required|string|max:255',
        'nomor_identitas' => 'required|string|max:255',
        'total_harga' => 'required|numeric',
    ]);

    // Find the Pemesanan
    $pemesanan = Pemesanan::findOrFail($id_pemesanan);

    // Create the DetailPemesanan record
    $detailPemesanan = new DetailPemesanan([
        'id_pemesanan' => $pemesanan->id_pemesanan,
        'id_kursi_bus' => $validated['id_kursi_bus'],
        'nama_penumpang' => $validated['nama_penumpang'],
        'nomor_identitas' => $validated['nomor_identitas'],
        'total_harga' => $validated['total_harga'],
    ]);

    // Save the DetailPemesanan
    $detailPemesanan->save();

    // After saving the detail, you may choose to redirect to a different page
    return redirect()->route('pemesanan.index')->with('success', 'Detail Pemesanan created successfully.');
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
