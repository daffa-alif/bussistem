<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Kelas;

class AddKelasCommand extends Command
{
    protected $signature = 'kelas:add';
    protected $description = 'Add a new class';

    public function handle()
    {
        $namaKelas = $this->ask('Nama Kelas');

        Kelas::create([
            'nama_kelas' => $namaKelas,
        ]);

        $this->info("Class berhasil ditambahkan!");
    }
}
