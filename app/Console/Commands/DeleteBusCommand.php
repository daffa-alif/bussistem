<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Bus;

class DeleteBusCommand extends Command
{
    protected $signature = 'bus:delete {id}';
    protected $description = 'Delete a bus by ID';

    public function handle()
    {
        $id = $this->argument('id');
        $bus = Bus::find($id);

        if (!$bus) {
            $this->error("Bus dengan ID $id tidak ditemukan.");
            return;
        }

        $bus->delete();
        $this->info("Bus dengan ID $id berhasil dihapus.");
    }
}
