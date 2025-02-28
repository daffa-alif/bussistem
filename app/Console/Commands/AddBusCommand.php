<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Bus;

class AddBusCommand extends Command
{
    protected $signature = 'bus:add';
    protected $description = 'Add a new bus';

    public function handle()
    {
        $namaBus = $this->ask('Nama Bus');
        $platNomor = $this->ask('Plat Nomor');
        $kapasitas = $this->ask('Kapasitas');

        Bus::create([
            'nama_bus' => $namaBus,
            'plat_nomor' => $platNomor,
            'kapasitas' => $kapasitas,
        ]);

        $this->info("Bus berhasil ditambahkan!");
    }
}
