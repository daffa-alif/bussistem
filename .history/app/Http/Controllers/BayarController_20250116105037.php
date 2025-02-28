<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;

class BayarController extends Controller
{
    // Display the payment page (bayar.index)
    public function index($id_pemesanan)
{
    // Fetch the Pemesanan along with its related detailPemesanan
    $pemesanan = Pemesanan::with('detailPemesanan')->findOrFail($id_pemesanan);

    // Check if the relationship is loaded properly
    if ($pemesanan->detailPemesanan->isEmpty()) {
        // Handle case where there are no related details
        return back()->with('error', 'No detail pemesanan found.');
    }

    // Calculate the total price by summing the 'total_harga' from the 'detailPemesanan' relationship
    $harga_bayar = $pemesanan->detailPemesanan->pluck('total_harga')->sum();

    // Return the view with the Pemesanan and the calculated harga_bayar
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

