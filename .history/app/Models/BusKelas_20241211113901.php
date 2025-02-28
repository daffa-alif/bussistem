<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusKelas extends Model
{
    use HasFactory;

    protected $table = 'bus_kelas';

    protected $fillable = ['id_bus', 'id_kelas'];

    // Relationships
    public function bus()
    {
        return $this->belongsTo(Bus::class, 'id_bus');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
}
