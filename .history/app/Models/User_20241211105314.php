<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Table name (if it's not the default 'users' table)
    protected $table = 'pengguna';

    // Fillable fields
    protected $fillable = [
        'name', 'email', 'password', 'role', 'nomor_telepon'
    ];

    // Hidden fields
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Cast attributes
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Additional relationships or methods (if necessary)
}
