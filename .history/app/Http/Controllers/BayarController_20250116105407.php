<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;

class BayarController extends Controller
{
    // Display the payment page (bayar.index)
    public function index($id_pemesanan)
{
    // Find the Pemesanan by its ID and load the related 'detailPemesanan'
    $pemesanan = Pemesanan::with('detailPemesanan')->findOrFail($id_pemesanan);

    // Check if detailPemesanan is loaded and has data
    if ($pemesanan->detailPemesanan->isEmpty()) {
        // If no details, set harga_bayar to 0 or handle accordingly
        $harga_bayar = 0;
    } else {
        // Sum the 'total_harga' from the related detailPemesanan for this specific pemesanan
        $harga_bayar = $pemesanan->detailPemesanan->sum('total_harga');
    }

    // Pass the Pemesanan and harga_bayar to the view
    return view('bayar.index', compact('pemesanan', 'harga_bayar'));
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

