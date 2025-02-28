<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetailPemesanan; // Add this import

class DetailPemesanan extends Model
{
    protected $table = 'detail_pemesanan';
    protected $fillable = [
    'id_pengguna',
    'id_jadwal',
    'status',
    'tanggal_pemesanan'  // Add this from the schema
];

    protected $primaryKey = 'id_detail_pemesanan';

    public function kursiBus()
    {
        return $this->belongsTo(KursiBus::class, 'id_kursi_bus', 'id_kursi');
    }

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan', 'id_pemesanan');
    }
}
