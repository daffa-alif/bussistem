<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;

class AdminPembayaranController extends Controller
{
    public function index()
    {
        // Fetch all pemesanan where status is 'booking' and load bukti_pembayaran relation
        $pemesanans = Pemesanan::with('bukti_pembayaran', 'user', 'detail_pemesanans')->where('status', 'booking')->get();

        return view('admin_pembayaran.index', compact('pemesanans'));
    }

    public function confirm($id_pemesanan)
    {
        // Find the pemesanan record
        $pemesanan = Pemesanan::findOrFail($id_pemesanan);

        // Update only the status column to 'confirmed'
        $pemesanan->update(['status' => 'confirmed']);

        return redirect()->route('admin.pembayaran')->with('status', 'Booking confirmed successfully.');
    }
}
