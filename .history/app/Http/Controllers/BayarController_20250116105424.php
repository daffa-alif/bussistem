<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;

class BayarController extends Controller
{
    // Display the payment page (bayar.index)
    public function index($id_pemesanan)
    {
        // Find the Pemesanan by its ID
        $pemesanan = Pemesanan::findOrFail($id_pemesanan);

        // Pass the Pemesanan to the view
        return view('bayar.index', compact('pemesanan'));
    }

     public function show($id_pemesanan)
    {
        // Fetch the Pemesanan record and its associated detail_pemesanan
        $pemesanan = Pemesanan::with('detailPemesanan')->findOrFail($id_pemesanan);

        // Calculate the total price by summing the 'total_harga' from detail_pemesanan
        $harga_bayar = $pemesanan->detailPemesanan->sum('total_harga');

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
