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
        $kursiBus = KursiBus::all(); // Fetch all kursi bus
        return view('detail_pemesanan.create', compact('pemesanan', 'kursiBus'));
    }
    
    public function getHarga(Request $request)
    {
        $kursiBus = KursiBus::find($request->id_kursi_bus);
    
        if (!$kursiBus) {
            return response()->json(['error' => 'Kursi tidak ditemukan'], 404);
        }
    
        // Assuming harga is related to kelas via kursi_bus
        $harga = Harga::where('id_kelas', $kursiBus->id_kelas)->first();
    
        if ($harga) {
            return response()->json(['harga_kursi' => $harga->harga]);
        }
    
        return response()->json(['error' => 'Harga tidak ditemukan'], 404);
    }
    
    
    


public function store(Request $request, $id_pemesanan)
{
    $pemesanan = Pemesanan::findOrFail($id_pemesanan);

    // Validate the incoming request
    $validated = $request->validate([
        'id_kursi_bus' => 'required|exists:kursi_bus,id_kursi', // Validate id_kursi exists in kursi_bus table
        'nama_penumpang' => 'required|string|max:100',
        'nomor_identitas' => 'required|string|max:50',
        'harga_kursi' => 'required|numeric|min:0',
        'total_harga' => 'required|numeric|min:0',
    ]);

    // Create the detail pemesanan
    DetailPemesanan::create([
        'id_pemesanan' => $pemesanan->id_pemesanan,
        'id_kursi_bus' => $validated['id_kursi_bus'], // Directly store id_kursi as id_kursi_bus
        'nama_penumpang' => $validated['nama_penumpang'],
        'nomor_identitas' => $validated['nomor_identitas'],
        'harga_kursi' => $validated['harga_kursi'],
        'total_harga' => $validated['total_harga'],
    ]);

    return redirect()->route('pemesanan.index')->with('success', 'Detail Pemesanan created successfully.');
}


}
