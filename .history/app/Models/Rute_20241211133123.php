<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rute extends Model
{
    use HasFactory;

    // Ensure this matches the table name in the database
    protected $table = 'rute'; // Table name in the database is 'rute'

    // Set the primary key if needed
    protected $primaryKey = 'id_rute'; // Primary key is 'id_rute'

    // Add any fillable fields
    protected $fillable = ['asal', 'tujuan', 'jarak_km'];
}

