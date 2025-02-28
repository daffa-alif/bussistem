<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Rute;

class EditRuteCommand extends Command
{
    protected $signature = 'rute:edit {id}';
    protected $description = 'Edit a route by ID';

    public function handle()
    {
        $id = $this->argument('id');
        $rute = Rute::find($id);

        if (!$rute) {
            $this->error("Route dengan ID $id tidak ditemukan.");
            return;
        }

        $this->info("Data rute saat ini:");
        $this->info("Asal: {$rute->asal}");
        $this->info("Tujuan: {$rute->tujuan}");
        $this->info("Jarak: {$rute->jarak_km} km");

        $asal = $this->ask('Asal baru (kosongkan untuk tetap sama)', $rute->asal);
        $tujuan = $this->ask('Tujuan baru (kosongkan untuk tetap sama)', $rute->tujuan);
        $jarakKm = $this->ask('Jarak baru (km, kosongkan untuk tetap sama)', $rute->jarak_km);

        $rute->update([
            'asal' => $asal,
            'tujuan' => $tujuan,
            'jarak_km' => $jarakKm,
        ]);

        $this->info("Route berhasil diperbarui!");
    }
}
