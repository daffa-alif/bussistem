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
}
