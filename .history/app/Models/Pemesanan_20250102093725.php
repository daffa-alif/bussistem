<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'pemesanan';

    // The primary key associated with the table.
    protected $primaryKey = 'id_pemesanan';

    // The attributes that are mass assignable.
    protected $fillable = [
        'id_pengguna',
        'id_jadwal',
        'status',
    ];

    // The relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'id_pengguna', 'id_pengguna');
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal', 'id_jadwal');
    }
}
