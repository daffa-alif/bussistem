<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pengguna;

class HapusPengguna extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pengguna:hapus {id : ID pengguna yang akan di hapus}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'menghapus pengguna berdasarkan ID';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id');
        
        $pengguna = Pengguna::find($id);

        if ($pengguna) {

            $pengguna->delete();
            $this->info("pengguna dengan ID $id berhasil dihapus.");
        } else {
            $this->error("pengguna dengan ID $id tidak ditemukan");
        }
    }
}
