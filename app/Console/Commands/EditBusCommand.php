<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Bus;

class EditBusCommand extends Command
{
    protected $signature = 'bus:edit {id}';
    protected $description = 'Edit a bus by ID';

    public function handle()
    {
        $id = $this->argument('id');
        $bus = Bus::find($id);

        if (!$bus) {
            $this->error("Bus dengan ID $id tidak ditemukan.");
            return;
        }

        $this->info("Data bus saat ini:");
        $this->info("Nama Bus: {$bus->nama_bus}");
        $this->info("Plat Nomor: {$bus->plat_nomor}");
        $this->info("Kapasitas: {$bus->kapasitas}");

        $namaBus = $this->ask('Nama Bus baru (kosongkan untuk tetap sama)', $bus->nama_bus);
        $platNomor = $this->ask('Plat Nomor baru (kosongkan untuk tetap sama)', $bus->plat_nomor);
        $kapasitas = $this->ask('Kapasitas baru (kosongkan untuk tetap sama)', $bus->kapasitas);

        $bus->update([
            'nama_bus' => $namaBus,
            'plat_nomor' => $platNomor,
            'kapasitas' => $kapasitas,
        ]);

        $this->info("Bus berhasil diperbarui!");
    }
}
