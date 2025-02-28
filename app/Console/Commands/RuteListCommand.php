<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Rute;

class RuteListCommand extends Command
{
    protected $signature = 'rute:list';
    protected $description = 'List all routes';

    public function handle()
    {
        $routes = Rute::all();

        if ($routes->isEmpty()) {
            $this->info("No routes found.");
        } else {
            $this->table(
                ['ID', 'Asal', 'Tujuan', 'Jarak (km)'],
                $routes->toArray()
            );
        }
    }
}
