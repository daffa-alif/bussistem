<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';
    protected $primaryKey = 'id_jadwal';

    protected $fillable = [
        'id_bus_rute', 'tanggal', 'waktu_berangkat', 'waktu_tiba', 'detail'
    ];

    // Relationships
    public function busRute()
    {
        return $this->belongsTo(BusRute::class, 'id_bus_rute');
    }

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'id_jadwal');
    }

    // Define a relationship to get the bus via busRute
    public function bus()
    {
        return $this->hasOneThrough(
            Bus::class,  // Target model
            BusRute::class, // Intermediate model
            'id_bus_rute', // Foreign key on BusRute
            'id_bus', // Foreign key on Bus
            'id_bus_rute', // Local key on Jadwal
            'id_bus' // Local key on BusRute
        );
    }
}
