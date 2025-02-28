<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPemesanan extends Model
{
    protected $table = 'detail_pemesanan';

    protected $fillable = [
        'id_pemesanan', 'id_kursi_bus', 'nama_penumpang',
        'nomor_identitas', 'harga_kursi', 'total_harga',
    ];

    public function kursiBus()
{
    return $this->belongsTo(KursiBus::class, 'id_kursi_bus', 'id_kursi');
}




}
