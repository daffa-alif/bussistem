<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';
    protected $primaryKey = 'id_jadwal';

    protected $fillable = ['id_bus_rute', 'tanggal', 'waktu_berangkat', 'waktu_tiba'];

    // Relationships
    public function busRute()
    {
        return $this->belongsTo(BusRute::class, 'id_bus_rute');
    }

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'id_jadwal');
    }
}
