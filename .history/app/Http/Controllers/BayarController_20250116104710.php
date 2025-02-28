<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;

class BayarController extends Controller
{
    // Display the payment page (bayar.index)
    public function index($id_pemesanan)
{
    // Fetch the Pemesanan record
    $pemesanan = Pemesanan::findOrFail($id_pemesanan);

    // Fetch related detail_pemesanan records with raw query
    $detail_pemesanan = \DB::table('detail_pemesanan')
        ->where('id_pemesanan', $id_pemesanan)
        ->get();

    dd($detail_pemesanan); // Dump the results

    // Calculate the total price from the fetched data
    $harga_bayar = $detail_pemesanan->sum('total_harga');

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

