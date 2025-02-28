<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;

class BayarController extends Controller
{
    // Display the payment page (bayar.index)
    public function index($id_pemesanan)
{
    // Load the Pemesanan and the related detailPemesanan
    $pemesanan = Pemesanan::with('detailPemesanan')->findOrFail($id_pemesanan);

    // Dump the individual values of total_harga
    dd($pemesanan->detailPemesanan->pluck('total_harga'));

    // Calculate the total price by summing the 'total_harga' from the plucked values
    $harga_bayar = $pemesanan->detailPemesanan->pluck('total_harga')->sum();

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

