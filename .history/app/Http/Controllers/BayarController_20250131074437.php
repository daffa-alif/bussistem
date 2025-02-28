<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\DetailPemesanan;
use Illuminate\Http\Request;

class BayarController extends Controller
{
    
    // Display the payment page (bayar.index)
    public function index($id_pemesanan)
{
    // Find the Pemesanan by id_pemesanan and load related detail_pemesanans
    $pemesanan = Pemesanan::with(['detail_pemesanans', 'jadwal', 'user'])->findOrFail($id_pemesanan);

    // Calculate the total price by summing the 'harga_kursi' from detail_pemesanans
    $hargaTotal = $pemesanan->detail_pemesanans->sum('harga_kursi');

    // Pass the data to the view
    return view('bayar.index', compact('pemesanan', 'hargaTotal'));
}



    

    // Confirm the payment and update the Pemesanan status to "confirmed"
    public function confirm($id_pemesanan)
    {
        $pemesanan = Pemesanan::findOrFail($id_pemesanan);

        // Update the status to 'confirmed'
        $pemesanan->status = 'booking';
        $pemesanan->save();

        // Redirect back to the pemesanan index with a success message
        return redirect()->route('pemesanan.index')->with('status', 'Pemesanan has been confirmed.');
    }
}
