<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Kelas;

class EditKelasCommand extends Command
{
    protected $signature = 'kelas:edit {id}';
    protected $description = 'Edit a class by ID';

    public function handle()
    {
        $id = $this->argument('id');
        $kelas = Kelas::find($id);

        if (!$kelas) {
            $this->error("Class dengan ID $id tidak ditemukan.");
            return;
        }

        $this->info("Data kelas saat ini:");
        $this->info("Nama Kelas: {$kelas->nama_kelas}");

        $namaKelas = $this->ask('Nama Kelas baru (kosongkan untuk tetap sama)', $kelas->nama_kelas);

        $kelas->update([
            'nama_kelas' => $namaKelas,
        ]);

        $this->info("Class berhasil diperbarui!");
    }
}
