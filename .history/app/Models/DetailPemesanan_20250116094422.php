<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPemesanan extends Model
{
    protected $table = 'detail_pemesanan';
    protected $fillable = ['id_pemesanan', 'id_kursi_bus', 'nama_penumpang', 'nomor_identitas', 'harga_kursi', 'total_harga'];

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

