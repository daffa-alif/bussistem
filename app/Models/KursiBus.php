<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KursiBus extends Model
{
    use HasFactory;

    protected $table = 'kursi_bus';
    protected $primaryKey = 'id_kursi';

    protected $fillable = ['id_bus', 'id_kelas', 'nomor_kursi', 'status_kursi'];

    // Relationships
    public function bus()
    {
        return $this->belongsTo(Bus::class, 'id_bus');
    }

    public function kelas()
{
    return $this->belongsTo(Kelas::class, 'id_kelas');
}


    // Add the relationship with DetailPemesanan
    public function detailPemesanan()
    {
        return $this->hasMany(DetailPemesanan::class, 'id_kursi_bus', 'id_kursi');
    }

    public function harga()
{
    return $this->hasOne(Harga::class, 'id_kelas', 'id_kelas');
}

}
