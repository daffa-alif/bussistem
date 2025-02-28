<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';

    protected $fillable = ['nama_kelas'];

    public function harga()
{
    return $this->hasOne(Harga::class, 'id_kelas');
}


    public function busKelas()
    {
        return $this->hasMany(BusKelas::class, 'id_kelas');
    }

    public function kursiBus()
    {
        return $this->hasMany(KursiBus::class, 'id_kelas');
    }
}
