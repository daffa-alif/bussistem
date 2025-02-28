<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPemesanan;
use App\Models\Pemesanan;
use App\Models\KursiBus;
use App\Models\Harga;

class DetailPemesananController extends Controller
{
    public function edit($id)
    {
        // Find the DetailPemesanan record by id_detail_pemesanan
        $detailPemesanan = DetailPemesanan::findOrFail($id);

        // Fetch related Pemesanan
        $pemesanan = Pemesanan::findOrFail($detailPemesanan->id_pemesanan);

        // Fetch available seats for the related bus
        $busId = $pemesanan->jadwal->bus->id_bus;
        $kursiBus = KursiBus::where('id_bus', $busId)->where('status_kursi', 'available')->get();

        return view('detail_pemesanan.edit', compact('detailPemesanan', 'pemesanan', 'kursiBus'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request, including the 'status' field
        $validated = $request->validate([
            'id_kursi_bus' => 'required|exists:kursi_bus,id_kursi',
            'nama_penumpang' => 'required|string|max:100',
            'nomor_identitas' => 'required|string|max:50',
            'status' => 'required|in:cancelled,pending',  // Only allow 'cancelled' and 'pending'
        ]);

        // Find the DetailPemesanan record
        $detailPemesanan = DetailPemesanan::findOrFail($id);

        // Fetch the KursiBus with related Kelas and Harga
        $kursiBus = KursiBus::with('kelas.harga')->findOrFail($validated['id_kursi_bus']);
        
        // Check if the KursiBus has a valid Kelas and Harga
        if (!$kursiBus->kelas || !$kursiBus->kelas->harga) {
            return redirect()->back()->withErrors(['error' => 'Harga tidak ditemukan untuk kursi ini.']);
        }

        // Access the Harga from the Kelas relationship
        $harga = $kursiBus->kelas->harga;

        // Update the DetailPemesanan record
        $detailPemesanan->update([
            'id_kursi_bus' => $validated['id_kursi_bus'],
            'nama_penumpang' => $validated['nama_penumpang'],
            'nomor_identitas' => $validated['nomor_identitas'],
            'harga_kursi' => $harga->harga,  // Use the `harga` from Kelas
            'total_harga' => $harga->harga,  // Calculate the total price
            'status' => $validated['status'],
        ]);

        return redirect()->route('detail_pemesanan.index', ['id_pemesanan' => $detailPemesanan->id_pemesanan])
                         ->with('success', 'Detail Pemesanan updated successfully.');
    }

    public function index($id_pemesanan)
    {
        // Fetch Pemesanan by ID
        $pemesanan = Pemesanan::findOrFail($id_pemesanan);

        // Fetch all details for the Pemesanan with the kursiBus, kelas, and harga relationships
        $detailPemesanan = DetailPemesanan::where('id_pemesanan', $id_pemesanan)
                                          ->with('kursiBus.kelas.harga')  // Eager load kursiBus, kelas, and harga
                                          ->get();

        return view('detail_pemesanan.index', compact('pemesanan', 'detailPemesanan'));
    }

    public function create($id_pemesanan)
{
    // Fetch the pemesanan with related jadwal and bus
    $pemesanan = Pemesanan::with(['jadwal.rute', 'jadwal.bus'])->findOrFail($id_pemesanan);

    // Get the bus ID
    $busId = $pemesanan->jadwal->bus->id_bus;

    // Fetch available seats for the bus
    $kursiBus = KursiBus::where('id_bus', $busId)
                        ->where('status_kursi', 'available')
                        ->get();

    // Fetch the route associated with the Pemesanan
    $rute = $pemesanan->jadwal->rute;

    // Prepare a mapping of prices for the route and class
    $hargaMapping = [];
    foreach ($rute->harga as $harga) {
        $hargaMapping[$harga->id_kelas] = $harga->harga;
    }

    return view('detail_pemesanan.create', compact('pemesanan', 'kursiBus', 'hargaMapping'));
}


    public function store(Request $request, $id_pemesanan)
    {
        $validated = $request->validate([
            'id_kursi_bus' => 'required|exists:kursi_bus,id_kursi',
            'nama_penumpang' => 'required|string|max:100',
            'nomor_identitas' => 'required|string|max:50',
        ]);

        // Fetch the KursiBus with related Kelas and Harga
        $kursiBus = KursiBus::with('kelas.harga')->findOrFail($validated['id_kursi_bus']);
        
        // Check if the KursiBus has a valid Kelas and Harga
        if (!$kursiBus->kelas || !$kursiBus->kelas->harga) {
            return redirect()->back()->withErrors(['error' => 'Harga tidak ditemukan untuk kursi ini.']);
        }

        // Access the Harga from the Kelas relationship
        $harga = $kursiBus->kelas->harga;

        // Create a new DetailPemesanan record
        DetailPemesanan::create([
            'id_pemesanan' => $id_pemesanan,
            'id_kursi_bus' => $validated['id_kursi_bus'],
            'nama_penumpang' => $validated['nama_penumpang'],
            'nomor_identitas' => $validated['nomor_identitas'],
            'harga_kursi' => $harga->harga,  // Use the `harga` from Kelas
            'total_harga' => $harga->harga,  // Calculate the total price
        ]);

        if ($request->action === 'add_another') {
            return redirect()->route('detail_pemesanan.create', $id_pemesanan)
                             ->with('success', 'Detail Pemesanan added. You can add another.');
        }

        if ($request->action === 'finish') {
            return redirect()->route('pemesanan.index')
                             ->with('success', 'Detail Pemesanan finalized.');
        }
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
