<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pemesanan extends Model
{
    protected $table = 'pemesanan'; // Assumes the table is named "pemesanan"

    protected $fillable = [
        'user_id', // If tied to a user, otherwise adjust based on your table
        'tanggal_pemesanan',
        'status_pemesanan',
    ];

    /**
     * Define the relationship with `DetailPemesanan`.
     * A `Pemesanan` can have many `DetailPemesanan` entries.
     */
    public function detailPemesanan(): HasMany
    {
        return $this->hasMany(DetailPemesanan::class, 'id_pemesanan');
    }
    
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal', 'id_jadwal');
    }

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'id_pengguna', 'id_pengguna');
    }
}
