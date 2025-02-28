<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Rute;

class AddRuteCommand extends Command
{
    protected $signature = 'rute:add';
    protected $description = 'Add a new route';

    public function handle()
    {
        $asal = $this->ask('Asal');
        $tujuan = $this->ask('Tujuan');
        $jarakKm = $this->ask('Jarak (km)');

        Rute::create([
            'asal' => $asal,
            'tujuan' => $tujuan,
            'jarak_km' => $jarakKm,
        ]);

        $this->info("Route berhasil ditambahkan!");
    }
}
