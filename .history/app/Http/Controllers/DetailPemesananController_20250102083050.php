<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPemesanan;
use App\Models\Pemesanan;

class DetailPemesananController extends Controller
{
    public function create($id_pemesanan)
    {
        $pemesanan = Pemesanan::findOrFail($id_pemesanan);
        return view('detail_pemesanan.create', compact('pemesanan'));
    }

    public function store(Request $request, $id_pemesanan)
    {
        $pemesanan = Pemesanan::findOrFail($id_pemesanan);

        // Validate the incoming request
        $validated = $request->validate([
            'id_kursi_bus' => 'required|exists:kursi_bus,id_kursi_bus',
            'nama_penumpang' => 'required|string|max:100',
            'nomor_identitas' => 'required|string|max:50',
            'harga_kursi' => 'required|numeric|min:0',
            'total_harga' => 'required|numeric|min:0',
        ]);

        // Create the detail pemesanan
        DetailPemesanan::create([
            'id_pemesanan' => $pemesanan->id_pemesanan,
            'id_kursi_bus' => $validated['id_kursi_bus'],
            'nama_penumpang' => $validated['nama_penumpang'],
            'nomor_identitas' => $validated['nomor_identitas'],
            'harga_kursi' => $validated['harga_kursi'],
            'total_harga' => $validated['total_harga'],
        ]);

        return redirect()->route('pemesanan.index')->with('success', 'Detail Pemesanan created successfully.');
    }

    
}
