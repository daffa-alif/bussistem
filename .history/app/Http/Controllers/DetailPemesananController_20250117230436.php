<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPemesanan;
use App\Models\Pemesanan;
use App\Models\Jadwal;
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

        $detailPemesanan = DetailPemesanan::findOrFail($id);
        $kursiBus = KursiBus::with('kelas.harga')->findOrFail($validated['id_kursi_bus']);

        if (!$kursiBus->kelas || !$kursiBus->kelas->harga) {
            return redirect()->back()->withErrors(['error' => 'Harga tidak ditemukan untuk kursi ini.']);
        }

        $harga = $kursiBus->kelas->harga;

        $detailPemesanan->update([
            'id_kursi_bus' => $validated['id_kursi_bus'],
            'nama_penumpang' => $validated['nama_penumpang'],
            'nomor_identitas' => $validated['nomor_identitas'],
            'harga_kursi' => $harga->harga,
            'total_harga' => $harga->harga,
            'status' => $validated['status'],
        ]);

        return redirect()->route('detail_pemesanan.index', ['id_pemesanan' => $detailPemesanan->id_pemesanan])
                         ->with('success', 'Detail Pemesanan updated successfully.');
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
    $validatedData = $request->validate([
        'id_kursi_bus' => 'required|exists:kursi_bus,id_kursi',
        'nama_penumpang' => 'required|string|max:255',
        'nomor_identitas' => 'required|string|max:255',
    ]);

    // Fetch `id_kelas` and `id_rute` via relationships
    $pemesanan = Pemesanan::findOrFail($id_pemesanan);
    $jadwal = Jadwal::findOrFail($pemesanan->id_jadwal);
    $busRute = BusRute::findOrFail($jadwal->id_bus_rute);
    $idRute = $busRute->id_rute;

    // Fetch `id_kelas` from `kursi_bus`
    $kursi = KursiBus::findOrFail($request->id_kursi_bus);
    $idKelas = $kursi->id_kelas;

    // Retrieve the price (`harga`) based on `id_rute` and `id_kelas`
    $harga = Harga::where('id_rute', $idRute)->where('id_kelas', $idKelas)->firstOrFail();

    // Calculate total_harga
    $totalHarga = $harga->harga;

    // Create a new DetailPemesanan record
    DetailPemesanan::create([
        'id_pemesanan' => $id_pemesanan,
        'id_kursi_bus' => $request->id_kursi_bus,
        'nama_penumpang' => $request->nama_penumpang,
        'nomor_identitas' => $request->nomor_identitas,
        'harga_kursi' => $harga->harga,
        'total_harga' => $totalHarga,
    ]);

    // Update kursi status to booked
    $kursi->update(['status_kursi' => 'booked']);

    if ($request->action === 'add_another') {
        return redirect()->back()->with('success', 'Penumpang berhasil ditambahkan!');
    } else {
        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan selesai!');
    }
}


    public function destroy($id)
    {
        $detailPemesanan = DetailPemesanan::findOrFail($id);
        $detailPemesanan->delete();

        return redirect()->route('detail_pemesanan.index', ['id_pemesanan' => $detailPemesanan->id_pemesanan])
                         ->with('success', 'Detail Pemesanan deleted successfully.');
    }
}
