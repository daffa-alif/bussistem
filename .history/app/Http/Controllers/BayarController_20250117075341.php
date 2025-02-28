<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\DetailPemesanan;
use Illuminate\Http\Request;

class BayarController extends Controller
{
    
    // Display the payment page (bayar.index)
    public function index()
{
    // Fetch all Pemesanan records and load related detail_pemesanans
    $pemesanans = Pemesanan::with(['detail_pemesanans', 'user', 'jadwal'])->get();

    // Calculate the total_harga for each pemesanan
    foreach ($pemesanans as $pemesanan) {
        $pemesanan->total_harga = $pemesanan->detailPemesanan->sum('harga_kursi');
    }

    // Pass the data to the view
    return view('bayar.index', compact('pemesanans'));
}


    

    // Confirm the payment and update the Pemesanan status to "confirmed"
    public function confirm($id_pemesanan)
    {
        $pemesanan = Pemesanan::findOrFail($id_pemesanan);

        // Update the status to 'confirmed'
        $pemesanan->status = 'confirmed';
        $pemesanan->save();

        // Redirect back to the pemesanan index with a success message
        return redirect()->route('pemesanan.index')->with('status', 'Pemesanan has been confirmed.');
    }
}
