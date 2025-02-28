<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Kelas;

class DeleteKelasCommand extends Command
{
    protected $signature = 'kelas:delete {id}';
    protected $description = 'Delete a class by ID';

    public function handle()
    {
        $id = $this->argument('id');
        $kelas = Kelas::find($id);

        if (!$kelas) {
            $this->error("Class dengan ID $id tidak ditemukan.");
            return;
        }

        $kelas->delete();
        $this->info("Class dengan ID $id berhasil dihapus.");
    }
}
