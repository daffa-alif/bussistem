<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;

class EditPengguna extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pengguna:edit {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'edit data pengguna';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id');
        $pengguna = Pengguna::find($id);

        if(!$pengguna){
            $this->error('Pengguna dengan id tersebut tidak ditemukan.');
            return Command::FALIURE;}

        $this->info("data pengguna saat ini:");
        $this->info("nama: {$pengguna->nama}");
        $this->info("email: {$pengguna->email}");
        $this->info("nomor telepon: {$pengguna->nomor_telepon}");
        $this->info("role: {$pengguna->role}");

        $nama = $this->ask('nama baru (kosongkan untuk tetap sama)', $pengguna->nama);
        $email = $this->ask('email baru (kosongkan untuk tetap sama)', $pengguna->email);
        $nomorTelepon = $this->ask('nomor telepon(kosongkan untuk tetap sama)', $pengguna->nomor_telepon);
        $role = $this->choice('role baru', ['admin','penumpang'], $pengguna->role);
        $password = $this->secret('password baru (kosongkan untuk tetap sama)');
        

        $pengguna->nama = $nama;
        $pengguna->email = $email;
        $pengguna->nomor_telepon = $nomorTelepon;
        $pengguna->role = $role;

        if (!empty($password)) {
            $pengguna->password = Hash::make($password);
        }

        $pengguna->save();

        $this->info('data pengguna berhasil di perbarui');
        return Command::SUCCESS;
    }
}
