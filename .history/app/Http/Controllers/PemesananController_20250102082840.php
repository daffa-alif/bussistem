<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Jadwal;
use App\Models\User;
use App\Models\KursiBus;

class PemesananController extends Controller
{
    public function index()
    {
        // Fetch all pemesanan with related user and jadwal data
        $pemesanan = Pemesanan::with(['user', 'jadwal'])->get();
        return view('pemesanan.index', compact('pemesanan'));
    }

    public function create()
    {
        $jadwal = Jadwal::all();
        $kursi_bus = KursiBus::with(['bus', 'kelas'])->where('status_kursi', 'available')->get();
        return view('pemesanan.create', compact('jadwal', 'kursi_bus'));
    }

    public function store(Request $request)
{
    // Automatically use the authenticated user
    $user = auth()->user();

    // Validate the incoming request
    $validated = $request->validate([
        'id_jadwal' => 'required|exists:jadwal,id_jadwal',
        'status' => 'required|in:pending,confirmed,cancelled,booking',
    ]);

    // Create a new pemesanan
    $pemesanan = Pemesanan::create([
        'id_pengguna' => $user->id_pengguna,
        'id_jadwal' => $validated['id_jadwal'],
        'status' => $validated['status'],
    ]);

    // Redirect to the detail creation form
    return redirect()->route('detail_pemesanan.create', $pemesanan->id_pemesanan)
                     ->with('success', 'Pemesanan created. Please add detail pemesanan.');
}


        // Assuming you want to update kursi_bus status when booking
        $kursiBus = KursiBus::find($request->id_kursi);
        if ($kursiBus) {
            $kursiBus->status_kursi = 'booked';  // Mark the seat as booked
            $kursiBus->save();
        }

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan created successfully.');
    }

    public function edit($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $jadwal = Jadwal::all();
        $users = User::all();
        return view('pemesanan.edit', compact('pemesanan', 'jadwal', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pengguna' => 'required|exists:users,id_pengguna',
            'id_jadwal' => 'required|exists:jadwal,id_jadwal',
            'status' => 'required|in:pending,confirmed,cancelled,booking',
        ]);

        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->update($request->only(['id_pengguna', 'id_jadwal', 'status']));

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan updated successfully.');
    }

    public function destroy($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->delete();

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan deleted successfully.');
    }
}
