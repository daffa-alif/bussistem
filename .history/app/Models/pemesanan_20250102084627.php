<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'jadwal';

    // The primary key associated with the table.
    protected $primaryKey = 'id_jadwal';

    // The attributes that are mass assignable.
    protected $fillable = [
        'detail', // Add any other fields in the 'jadwal' table
    ];
}
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
