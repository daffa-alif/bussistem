<?php

nnamespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Jadwal;
use App\Models\User;
use App\Models\KursiBus;

class PemesananController extends Controller
{
    // Display the list of Pemesanan with related user and jadwal data
    public function index()
    {
        // Fetch all pemesanan with related user and jadwal data
        $pemesanan = Pemesanan::with(['user', 'jadwal'])->get();

        // Fetch all jadwal data to pass to the view
        $jadwal = Jadwal::all();

        // Pass both pemesanan and jadwal to the view
        return view('pemesanan.index', compact('pemesanan', 'jadwal'));
    }

    // Show the form to create a new Pemesanan
    public function create()
    {
        // Fetch all jadwal and select only the relevant columns (waktu_berangkat, waktu_tiba)
        $jadwal = Jadwal::all(['id_jadwal', 'waktu_berangkat', 'waktu_tiba']);

        // Fetch available kursi_bus for booking
        $kursi_bus = KursiBus::with(['bus', 'kelas'])->where('status_kursi', 'available')->get();

        // Pass jadwal and kursi_bus to the view
        return view('pemesanan.create', compact('jadwal', 'kursi_bus'));
    }

    // Store a newly created Pemesanan in the database
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'id_jadwal' => 'required|exists:jadwal,id_jadwal',  // Ensure the jadwal exists in the database
            'status' => 'required|in:pending,confirmed,cancelled,booking',  // Ensure valid status
            'id_kursi' => 'nullable|exists:kursi_bus,id_kursi',  // Ensure the kursi exists if provided
        ]);

        // Retrieve the authenticated user
        $user = auth()->user();  // Automatically fetch the authenticated user

        // Create a new Pemesanan record
        $pemesanan = Pemesanan::create([
            'id_pengguna' => $user->id_pengguna,  // Reference the authenticated user's ID
            'id_jadwal' => $validated['id_jadwal'],
            'status' => $validated['status'],
            'tanggal_pemesanan' => now(),  // Automatically set the current timestamp
        ]);

        // Update the KursiBus status if id_kursi is provided
        if (!empty($request->id_kursi)) {
            $kursiBus = KursiBus::find($request->id_kursi);
            if ($kursiBus) {
                $kursiBus->status_kursi = 'booked';  // Mark the seat as booked
                $kursiBus->save();
            }
        }

        // Redirect to the Pemesanan index page with a success message
        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan created successfully.');
    }

    // Show the form to edit the specified Pemesanan
    public function edit($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $jadwal = Jadwal::all();
        $users = User::all();
        return view('pemesanan.edit', compact('pemesanan', 'jadwal', 'users'));
    }

    // Update the specified Pemesanan in the database
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

    // Remove the specified Pemesanan from the database
    public function destroy($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->delete();

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan deleted successfully.');
    }
}
