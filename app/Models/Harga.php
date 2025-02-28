<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    use HasFactory;

    protected $table = 'harga';
    protected $primaryKey = 'id_harga';

    protected $fillable = ['id_rute', 'id_kelas', 'harga'];

    // Relationships
    public function rute()
    {
        return $this->belongsTo(Rute::class, 'id_rute');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
}
