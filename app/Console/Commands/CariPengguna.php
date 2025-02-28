<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pengguna;

class CariPengguna extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pengguna:cari {search : nama atau email pengguna yang ingin dicari}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'mencari berdasarkan nama atau email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $search = $this->argument('search');
        $pengguna = Pengguna::where('nama', 'LIKE', "%$search$%")->orwhere('email', 'LIKE', "%$search%")->orwhere('id_pengguna','LIKE',"%$search%")->get();

        if ($pengguna->isEmpty()) {
            $this->error("tidak ditemukan pengguna dengan id pengguna atau nama atau email yang mengandung '$search");
        } else {
            $this->info("hasil pencarian untuk '$search' : ");
            $this->table(
                ['ID','Nama', 'Email', 'Nomor Telepon', 'Role'],
                $pengguna->toArray()
            );
        }
    }
}
