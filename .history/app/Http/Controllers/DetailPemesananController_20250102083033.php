<?php

namespace App\Http\Controllers;

use App\Models\DetailPemesanan;
use App\Models\Pemesanan;
use App\Models\KursiBus;
use Illuminate\Http\Request;

class DetailPemesananController extends Controller
{
    public function index()
    {
        $detailPemesanan = DetailPemesanan::all();
        return view('detail-pemesanan.index', compact('detailPemesanan'));
    }

    public function create()
    {
        $pemesanan = Pemesanan::all();
        $kursiBuses = KursiBus::all();
        return view('detail-pemesanan.create', compact('pemesanan', 'kursiBuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pemesanan' => 'required|exists:pemesanan,id_pemesanan',
            'id_kursi_bus' => 'required|exists:kursi_bus,id_kursi',
            'nama_penumpang' => 'required|string|max:100',
            'nomor_identitas' => 'required|string|max:50',
            'harga_kursi' => 'required|numeric',
            'total_harga' => 'required|numeric',
        ]);

        DetailPemesanan::create($request->all());
        return redirect()->route('detail-pemesanan.index')->with('success', 'Detail pemesanan created successfully!');
    }

    public function edit($id)
    {
        $detailPemesanan = DetailPemesanan::findOrFail($id);
        $pemesanan = Pemesanan::all();
        $kursiBuses = KursiBus::all();
        return view('detail-pemesanan.edit', compact('detailPemesanan', 'pemesanan', 'kursiBuses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pemesanan' => 'required|exists:pemesanan,id_pemesanan',
            'id_kursi_bus' => 'required|exists:kursi_bus,id_kursi',
            'nama_penumpang' => 'required|string|max:100',
            'nomor_identitas' => 'required|string|max:50',
            'harga_kursi' => 'required|numeric',
            'total_harga' => 'required|numeric',
        ]);

        $detailPemesanan = DetailPemesanan::findOrFail($id);
        $detailPemesanan->update($request->all());
        return redirect()->route('detail-pemesanan.index')->with('success', 'Detail pemesanan updated successfully!');
    }

    public function destroy($id)
    {
        $detailPemesanan = DetailPemesanan::findOrFail($id);
        $detailPemesanan->delete();
        return redirect()->route('detail-pemesanan.index')->with('success', 'Detail pemesanan deleted successfully!');
    }
}
