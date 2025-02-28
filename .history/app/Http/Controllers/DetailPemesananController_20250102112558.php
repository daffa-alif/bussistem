<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPemesanan;
use App\Models\Pemesanan;
use App\Models\KursiBus;

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
        $pemesanan = Pemesanan::findOrFail($id_pemesanan);
        // Fetch available kursi
        $kursiBus = KursiBus::where('status_kursi', 'available')->get(); 
        return view('detail_pemesanan.create', compact('pemesanan', 'kursiBus'));
    }


    public function store(Request $request, $id_pemesanan)
    {
        $pemesanan = Pemesanan::findOrFail($id_pemesanan);
    
        // Validate the incoming request
        $validated = $request->validate([
            'id_kursi_bus' => 'required|exists:kursi_bus,id_kursi',
            'nama_penumpang' => 'required|string|max:100',
            'nomor_identitas' => 'required|string|max:50',
        ]);
    
        // Fetch the selected kursi_bus and its related kelas
        $kursiBus = KursiBus::findOrFail($validated['id_kursi_bus']);
    
        // Fetch the corresponding harga for the kelas of the kursi_bus
        $harga = Harga::where('id_kelas', $kursiBus->id_kelas)->first();
    
        if (!$harga) {
            return redirect()->back()->with('error', 'Harga for the selected kelas is not available.');
        }
    
        // Calculate the total price, if needed
        $total_harga = $harga->harga;
    
        // Create the detail pemesanan
        DetailPemesanan::create([
            'id_pemesanan' => $pemesanan->id_pemesanan,
            'id_kursi_bus' => $validated['id_kursi_bus'],
            'nama_penumpang' => $validated['nama_penumpang'],
            'nomor_identitas' => $validated['nomor_identitas'],
            'harga_kursi' => $harga->harga,
            'total_harga' => $total_harga,
        ]);
    
        return redirect()->route('pemesanan.index')->with('success', 'Detail Pemesanan created successfully.');
    }
    


}
