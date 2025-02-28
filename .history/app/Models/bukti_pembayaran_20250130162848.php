<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bukti_pembayaran extends Model
{
    protected $table = 'bukti_pembayaran';

    protected $fillable = 'id_pemesanan, file_name';

    public function buktiPmemb(){
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }
}
