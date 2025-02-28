<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rute extends Model
{
    use HasFactory;

    protected $table = 'rute';
    protected $primaryKey = 'id_rute';

    protected $fillable = ['asal', 'tujuan', 'jarak_km'];

    public function harga()
    {
        return $this->hasMany(Harga::class, 'id_rute');
    }

    public function busRute()
    {
        return $this->hasMany(BusRute::class, 'id_rute');
    }
}
