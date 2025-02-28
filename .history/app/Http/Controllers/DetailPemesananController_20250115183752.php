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


@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Detail Pemesanan</h1>

    <form action="{{ route('detail_pemesanan.update', $detailPemesanan->id_detail_pemesanan) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_penumpang" class="form-label">Nama Penumpang</label>
            <input type="text" class="form-control" id="nama_penumpang" name="nama_penumpang" value="{{ $detailPemesanan->nama_penumpang }}" required>
        </div>

        <div class="mb-3">
            <label for="nomor_identitas" class="form-label">Nomor Identitas</label>
            <input type="text" class="form-control" id="nomor_identitas" name="nomor_identitas" value="{{ $detailPemesanan->nomor_identitas }}" required>
        </div>

        <div class="mb-3">
            <label for="id_kursi_bus" class="form-label">Kursi</label>
            <select class="form-select" id="id_kursi_bus" name="id_kursi_bus" required>
                <option value="" disabled>Pilih Kursi</option>
                @foreach ($kursiBus as $kursi)
                    <option value="{{ $kursi->id_kursi }}" {{ $kursi->id_kursi == $detailPemesanan->id_kursi_bus ? 'selected' : '' }}>
                        {{ $kursi->nomor_kursi }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <option value="pending" {{ $detailPemesanan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="cancelled" {{ $detailPemesanan->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('detail_pemesanan.index', $pemesanan->id_pemesanan) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection



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
        $pemesanan = Pemesanan::findOrFail($id_pemesanan);
   
        $validated = $request->validate([
            'id_kursi_bus' => 'required|exists:kursi_bus,id_kursi',
            'nama_penumpang' => 'required|string|max:100',
            'nomor_identitas' => 'required|string|max:50',
        ]);
   
        // Ambil harga dari kursi terkait
        $kursiBus = KursiBus::findOrFail($validated['id_kursi_bus']);
        $harga = Harga::where('id_kelas', $kursiBus->id_kelas)->first();
   
        if (!$harga) {
            return redirect()->back()->withErrors(['error' => 'Harga tidak ditemukan']);
        }
   
        $totalHarga = $harga->harga; // Sesuaikan dengan jumlah penumpang jika ada
   
        DetailPemesanan::create([
            'id_pemesanan' => $pemesanan->id_pemesanan,
            'id_kursi_bus' => $validated['id_kursi_bus'],
            'nama_penumpang' => $validated['nama_penumpang'],
            'nomor_identitas' => $validated['nomor_identitas'],
            'harga_kursi' => $harga->harga,
            'total_harga' => $totalHarga,
        ]);
   
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
