<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Pemesanan;

use App\Models\Bus;
use App\Models\Jadwal;
use App\Models\User;
use App\Models\KursiBus;

class PemesananController extends Controller
{

    public function deleteCancelled()
{
    Pemesanan::where('status', 'cancelled')->delete();
    return redirect()->route('pemesanan.index')->with('success', 'All cancelled bookings have been deleted.');
}


    public function cancel($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->status = 'cancelled'; // Update the status
        $pemesanan->save();
    
        return redirect()->back()->with('success', 'Booking has been cancelled.');
    }
    


    public function index()
{
    if (auth()->user()->role === 'admin') {
        // Fetch all pemesanan records for admin, ordered by the latest creation or booking date
        $pemesanan = Pemesanan::with(['user', 'jadwal', 'detailPemesanan']) // Include 'detailPemesanan'
            ->orderBy('tanggal_pemesanan', 'desc') // Adjust column to 'created_at' if preferred
            ->get();
    } else {
        // Fetch pemesanan records for the authenticated user, ordered by the latest
        $pemesanan = Pemesanan::with(['user', 'jadwal', 'detailPemesanan']) // Include 'detailPemesanan'
            ->where('id_pengguna', auth()->id())
            ->orderBy('tanggal_pemesanan', 'desc') // Adjust column to 'created_at' if preferred
            ->get();
    }

    // Add total_harga for each Pemesanan by summing the harga_kursi from DetailPemesanan
    foreach ($pemesanan as $item) {
        $item->total_harga = $item->detailPemesanan->sum('harga_kursi');
    }

    return view('pemesanan.index', compact('pemesanan'));
}



public function getAvailableSeats($id_jadwal)
{
    $jadwal = Jadwal::with('busRute.bus.kursiBus')->findOrFail($id_jadwal);
    
    $availableSeats = $jadwal->busRute->bus->kursiBus()->where('status_kursi', 'available')->get();

    return response()->json([
        'seats' => $availableSeats
    ]);
}



public function create(Request $request)
{
    $busId = $request->input('bus_id'); // Get the selected bus ID
    $users = User::all(); // Fetch all users if admin role
    $jadwal = Jadwal::whereHas('busRute', function ($query) use ($busId) {
        $query->where('id_bus', $busId);
    })->get(); // Filter jadwal by the selected bus

    $bus = Bus::find($busId); // Fetch bus details for display

    return view('pemesanan.create', compact('users', 'jadwal', 'bus'));
}




    public function fetchDetailPemesanan($id_pemesanan)
{
    $detailPemesanan = DetailPemesanan::where('id_pemesanan', $id_pemesanan)->get();
    return response()->json($detailPemesanan);
}




public function store(Request $request)
{
    // Validate the incoming request
    $validated = $request->validate([
        'id_jadwal' => 'required|exists:jadwal,id_jadwal',
        'status' => 'required|in:pending,confirmed,cancelled,booking',
        'id_kursi' => 'nullable|exists:kursi_bus,id_kursi',
        'id_pengguna' => 'nullable|exists:pengguna,id_pengguna',
    ]);

    // Retrieve the authenticated user if no id_pengguna is provided
    $user = $validated['id_pengguna'] ?? auth()->user()->id_pengguna;

    // Create a new Pemesanan record
    $pemesanan = Pemesanan::create([
        'id_pengguna' => $user,
        'id_jadwal' => $validated['id_jadwal'],
        'status' => $validated['status'],
        'tanggal_pemesanan' => now(),
    ]);

    // If kursi is selected, use its price for total_harga
    $totalHarga = null;
    if (!empty($request->id_kursi)) {
        $kursiBus = KursiBus::find($request->id_kursi);
        if ($kursiBus) {
            $kursiBus->status_kursi = 'booked';  // Mark the seat as booked
            $kursiBus->save();
            $totalHarga = $kursiBus->harga;  // Get the price of the selected seat
        }
    }

    // Redirect to the detail_pemesanan.create with id_pemesanan and kursi data
    return redirect()->route('detail_pemesanan.create', [
        'id_pemesanan' => $pemesanan->id_pemesanan,
        'id_kursi' => $request->id_kursi,
        'total_harga' => $totalHarga
    ])->with('success', 'Pemesanan created successfully.');
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
        'id_pengguna' => 'nullable|exists:pengguna,id_pengguna',
        'id_jadwal' => 'required|exists:jadwal,id_jadwal',
        'status' => 'required|in:pending,confirmed,cancelled,booking',  // Validate status
    ]);

    // Set the id_pengguna to the first user if not provided
    $user = $request->input('id_pengguna') ?? User::first()->id_pengguna;

    $pemesanan = Pemesanan::findOrFail($id);
    $pemesanan->update($request->only(['id_jadwal', 'status']) + ['id_pengguna' => $user]);

    return redirect()->route('pemesanan.index')->with('success', 'Pemesanan updated successfully.');
}




    

    public function destroy($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->delete();

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan deleted successfully.');
    }
}
