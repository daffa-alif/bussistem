<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Rute;

class DeleteRuteCommand extends Command
{
    protected $signature = 'rute:delete {id}';
    protected $description = 'Delete a route by ID';

    public function handle()
    {
        $id = $this->argument('id');
        $rute = Rute::find($id);

        if (!$rute) {
            $this->error("Route dengan ID $id tidak ditemukan.");
            return;
        }

        $rute->delete();
        $this->info("Route dengan ID $id berhasil dihapus.");
    }
}
