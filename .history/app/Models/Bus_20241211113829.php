<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $table = 'bus';
    protected $primaryKey = 'id_bus';

    protected $fillable = ['nama_bus', 'plat_nomor', 'kapasitas'];

    // Relationships
    public function busRute()
    {
        return $this->hasMany(BusRute::class, 'id_bus');
    }

    public function busKelas()
    {
        return $this->hasMany(BusKelas::class, 'id_bus');
    }

    public function kursiBus()
    {
        return $this->hasMany(KursiBus::class, 'id_bus');
    }
}
