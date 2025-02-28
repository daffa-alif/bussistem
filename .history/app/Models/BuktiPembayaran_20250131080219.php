<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BuktiPembayaran extends Model
{
    use HasFactory;

    protected $table = 'bukti_pembayaran';

    protected $fillable = ['id_pemesanan', 'file_name'];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }

    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->file_name);
    }
}
