<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\DetailPemesanan;
use App\Models\BuktiPembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BayarController extends Controller
{
    public function index($id_pemesanan)
    {
        $pemesanan = Pemesanan::with(['detail_pemesanans', 'jadwal', 'user'])->findOrFail($id_pemesanan);
        $hargaTotal = $pemesanan->detail_pemesanans->sum('harga_kursi');

        return view('bayar.index', compact('pemesanan', 'hargaTotal'));
    }

    public function confirm(Request $request, $id_pemesanan)
    {
        $pemesanan = Pemesanan::findOrFail($id_pemesanan);

        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('bukti_pembayaran', $fileName, 'public');
        
            // Create the BuktiPembayaran with the correct pemesanan id
            BuktiPembayaran::create([
                'id_pemesanan' => $pemesanan->id,  // Ensure that the Pemesanan id is set here
                'file_name' => $filePath,
            ]);
        }
        

        $pemesanan->status = 'booking';
        $pemesanan->save();

        return redirect()->route('pemesanan.index')->with('status', 'Pemesanan has been confirmed.');
    }
}
