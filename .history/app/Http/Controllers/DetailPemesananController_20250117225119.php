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
        $detailPemesanan = DetailPemesanan::findOrFail($id);

        $pemesanan = Pemesanan::with('jadwal.bus')->findOrFail($detailPemesanan->id_pemesanan);

        $busId = $pemesanan->jadwal->bus->id_bus;
        $kursiBus = KursiBus::where('id_bus', $busId)->where('status_kursi', 'available')->get();

        return view('detail_pemesanan.edit', compact('detailPemesanan', 'pemesanan', 'kursiBus'));
    }

    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'id_kursi_bus' => 'required|exists:kursi_bus,id_kursi',
        'nama_penumpang' => 'required|string|max:100',
        'nomor_identitas' => 'required|string|max:50',
        'status' => 'required|in:cancelled,pending',
    ]);

    // Find the DetailPemesanan record
    $detailPemesanan = DetailPemesanan::findOrFail($id);

    // Fetch the KursiBus and its related Kelas
    $kursiBus = KursiBus::with('kelas')->findOrFail($validated['id_kursi_bus']);

    // Fetch the related Pemesanan with the Jadwal and Rute
    $pemesanan = Pemesanan::with('jadwal.rute')->findOrFail($detailPemesanan->id_pemesanan);

    // Ensure the KursiBus has a valid Kelas
    if (!$kursiBus->kelas) {
        return redirect()->back()->withErrors(['error' => 'Kelas tidak ditemukan untuk kursi ini.']);
    }

    // Fetch the Harga based on the Rute and Kelas
    $harga = Harga::where('id_rute', $pemesanan->jadwal->rute->id_rute)
                  ->where('id_kelas', $kursiBus->id_kelas)
                  ->first();

    if (!$harga) {
        return redirect()->back()->withErrors(['error' => 'Harga tidak ditemukan untuk rute dan kelas ini.']);
    }

    // Update the DetailPemesanan record
    $detailPemesanan->update([
        'id_kursi_bus' => $validated['id_kursi_bus'],
        'nama_penumpang' => $validated['nama_penumpang'],
        'nomor_identitas' => $validated['nomor_identitas'],
        'harga_kursi' => $harga->harga, // Correct price based on Rute and Kelas
        'total_harga' => $harga->harga, // Total price (can be adjusted for discounts, etc.)
        'status' => $validated['status'],
    ]);

    return redirect()->route('detail_pemesanan.index', ['id_pemesanan' => $detailPemesanan->id_pemesanan])
                     ->with('success', 'Detail Pemesanan berhasil diperbarui.');
}


    public function index($id_pemesanan)
    {
        $pemesanan = Pemesanan::with('jadwal')->findOrFail($id_pemesanan);

        $detailPemesanan = DetailPemesanan::where('id_pemesanan', $id_pemesanan)
                                          ->with('kursiBus.kelas.harga')
                                          ->get();

        return view('detail_pemesanan.index', compact('pemesanan', 'detailPemesanan'));
    }

    public function create($id_pemesanan)
    {
        $pemesanan = Pemesanan::with(['jadwal.rute', 'jadwal.bus'])->findOrFail($id_pemesanan);

        $busId = $pemesanan->jadwal->bus->id_bus;
        $kursiBus = KursiBus::where('id_bus', $busId)->where('status_kursi', 'available')->get();

        $rute = $pemesanan->jadwal->rute;

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

    // Fetch the KursiBus and its related Kelas
    $kursiBus = KursiBus::with('kelas')->findOrFail($validated['id_kursi_bus']);

    // Fetch the related Pemesanan with the Jadwal and Rute
    $pemesanan = Pemesanan::with('jadwal.rute')->findOrFail($id_pemesanan);

    // Ensure the KursiBus has a valid Kelas
    if (!$kursiBus->kelas) {
        return redirect()->back()->withErrors(['error' => 'Kelas tidak ditemukan untuk kursi ini.']);
    }

    // Fetch the Harga based on the Rute and Kelas
    $harga = Harga::where('id_rute', $pemesanan->jadwal->rute->id_rute)
                  ->where('id_kelas', $kursiBus->id_kelas)
                  ->first();

    if (!$harga) {
        return redirect()->back()->withErrors(['error' => 'Harga tidak ditemukan untuk rute dan kelas ini.']);
    }

    // Create a new DetailPemesanan record
    DetailPemesanan::create([
        'id_pemesanan' => $id_pemesanan,
        'id_kursi_bus' => $validated['id_kursi_bus'],
        'nama_penumpang' => $validated['nama_penumpang'],
        'nomor_identitas' => $validated['nomor_identitas'],
        'harga_kursi' => $harga->harga, // Correct price based on Rute and Kelas
        'total_harga' => $harga->harga, // Total price (can be adjusted for discounts, etc.)
    ]);

    return redirect()->route('detail_pemesanan.index', ['id_pemesanan' => $id_pemesanan])
                     ->with('success', 'Detail Pemesanan berhasil ditambahkan.');
}


    public function destroy($id)
    {
        $detailPemesanan = DetailPemesanan::findOrFail($id);
        $detailPemesanan->delete();

        return redirect()->route('detail_pemesanan.index', ['id_pemesanan' => $detailPemesanan->id_pemesanan])
                         ->with('success', 'Detail Pemesanan deleted successfully.');
    }
}
