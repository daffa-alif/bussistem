<?php

namespace App\Http\Controllers;

use App\Models\DetailPemesanan;
use App\Models\Pemesanan;
use App\Models\KursiBus;
use App\Models\Harga;
use Illuminate\Http\Request;

class PenggunaDetailController extends Controller
{
    public function index(Request $request)
    {
        // Filter data berdasarkan pengguna (opsional, jika ada relasi pengguna)
        $idPengguna = $request->user()->id ?? null; // Ambil ID pengguna dari session/login
        $details = DetailPemesanan::whereHas('pemesanan', function ($query) use ($idPengguna) {
            $query->where('id_pengguna', $idPengguna);
        })->with(['pemesanan', 'kursiBus'])->get();

        return view('pengguna_detail.index', compact('details'));
    }

    public function create(Request $request)
    {
        $idPemesanan = $request->query('id_pemesanan');
        if (!$idPemesanan) {
            abort(404, 'ID Pemesanan tidak ditemukan');
        }
        
        // Validasi apakah pemesanan milik pengguna yang login
        $pemesanan = Pemesanan::with([
            'jadwal.busRute.rute',
            'jadwal.busRute.bus'
        ])
        ->where('id_pengguna', auth()->id())
        ->findOrFail($idPemesanan);
        
        $idBus = $pemesanan->jadwal->busRute->id_bus;
        $idRute = $pemesanan->jadwal->busRute->id_rute;
        
        $kursiBuses = KursiBus::where('id_bus', $idBus)
            ->with(['bus', 'kelas'])
            ->get();
        
        $hargaPerKelas = Harga::where('id_rute', $idRute)
            ->get()
            ->keyBy('id_kelas');
    
        return view('bus_travel.detail', compact('kursiBuses', 'idPemesanan', 'hargaPerKelas', 'pemesanan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kursi_bus.*' => 'required|exists:kursi_bus,id_kursi_bus',
            'nama_penumpang.*' => 'required|string|max:255',
            'nomor_identitas.*' => 'required|string|max:255',
            'harga_kursi.*' => 'required|numeric',
            'total_harga.*' => 'required|numeric',
        ]);

        foreach ($request->id_kursi_bus as $key => $kursi) {
            DetailPemesanan::create([
                'id_pemesanan' => $request->id_pemesanan,
                'id_kursi_bus' => $kursi,
                'nama_penumpang' => $request->nama_penumpang[$key],
                'nomor_identitas' => $request->nomor_identitas[$key],
                'harga_kursi' => $request->harga_kursi[$key],
                'total_harga' => $request->total_harga[$key],
            ]);
        }

        return redirect()->route('pengguna_detail.index')->with('success', 'Detail pemesanan berhasil dibuat.');
    }

    public function edit(DetailPemesanan $detailPemesanan)
    {
        abort(403, 'Pengguna tidak dapat mengedit detail pemesanan melalui interface ini.');
    }

    public function destroy(DetailPemesanan $detailPemesanan)
    {
        abort(403, 'Pengguna tidak dapat menghapus detail pemesanan melalui interface ini.');
    }
}
