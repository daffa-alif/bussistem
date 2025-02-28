<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPemesanan extends Model
{
    protected $table = 'detail_pemesanan'; // Ensure this matches the database table name
    protected $primaryKey = 'id_detail_pemesanan'; // Primary key for the table

    // Define the inverse relationship
    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan', 'id_pemesanan');
    }

    public function kursiBus()
    {
        return $this->belongsTo(KursiBus::class, 'id_kursi_bus', 'id_kursi');
    }
}
