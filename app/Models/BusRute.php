<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusRute extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'bus_rute';

    // Primary key column
    protected $primaryKey = 'id_bus_rute';

    // Fillable fields
    protected $fillable = ['id_bus', 'id_rute'];

    // Relationship with Bus
    public function bus()
    {
        return $this->belongsTo(Bus::class, 'id_bus');
    }

    // Relationship with Rute
    public function rute()
    {
        return $this->belongsTo(Rute::class, 'id_rute');
    }
}

