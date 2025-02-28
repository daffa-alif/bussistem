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
        $pemesanan = Pemesanan::findOrFail($id_pemesanan);
        $kursiBus = KursiBus::all(); // Fetch all kursi bus
        return view('detail_pemesanan.create', compact('pemesanan', 'kursiBus'));
    }
    
   // In DetailPemesananController.php

   public function getHarga($id_kelas)
   {
       $harga = Harga::where('id_kelas', $id_kelas)->first();
       if ($harga) {
           return response()->json(['harga_kursi' => $harga->harga], 200);
       }
       return response()->json(['error' => 'Harga not found'], 404);
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
   


}
