<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;

class AddPengguna extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pengguna:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tambah Pengguna Baru';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $nama = $this->ask('nama');
        $email = $this->ask('email');
        $nomorTelepon = $this->ask('Nomor Telepon (Optional)');
        $role = $this->choice('role', ['admin', 'penumpang'], 1);
        $password = $this->secret('Masukkan password (minimal 8 karaketer) : ');
        
        while (empty($password) || strlen($password) < 8){
            $this->error('password harus minimal 8 karakter. ');
            $password = $this->secret('Masukkan password (minimal 8 karaketer) : ');
        }

        Pengguna::create([
            'nama'=> $nama,
            'email'=> $email,
            'password' => Hash::make($password),
            'nomor_telepon'=> $nomorTelepon,
            'role' => $role
        ]);

        $this->info('pengguna berhasil ditambahkan!');
    }

    
}
