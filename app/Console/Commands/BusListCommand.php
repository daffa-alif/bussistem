<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Bus;

class BusListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bus:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all buses';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $buses = Bus::all();

        if ($buses->isEmpty()) {
            $this->info("No buses found.");
        } else {
            $this->table(
                ['ID', 'Nama Bus', 'Plat Nomor', 'Kapasitas'],
                $buses->toArray()
            );
        }
    }
}
