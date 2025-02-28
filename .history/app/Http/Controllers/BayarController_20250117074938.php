<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\DetailPemesanan;
use Illuminate\Http\Request;

class BayarController extends Controller
{
    public function fetchHarga($id_pemesanan)
{
    // Find the Pemesanan record by id_pemesanan
    $pemesanan = Pemesanan::with('detail_pemesanans')->findOrFail($id_pemesanan);

    // Calculate the total price by summing the 'total_harga' from detail_pemesanans
    $hargaTotal = $pemesanan->detail_pemesanans->sum('total_harga');

    return view('bayar.', compact('pemesanan', 'hargaTotal'));
}

    // Display the payment page (bayar.index)
    public function index($id_pemesanan)
    {
        // Find the Pemesanan by its ID
        $pemesanan = Pemesanan::findOrFail($id_pemesanan);

        // Pass the Pemesanan to the view
        return view('bayar.index', compact('pemesanan'));
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
