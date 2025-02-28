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
    // Update the relationship name in the eager loading
    $pemesanan = Pemesanan::with('detail_pemesanans')->findOrFail($id_pemesanan);

    // Update the property access
    $harga_bayar = $pemesanan->detail_pemesanans->sum('total_harga');

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
