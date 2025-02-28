<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pengguna;

class PenggunaListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pengguna:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all pengguna data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $pengguna = Pengguna::all();

        if($pengguna->isEmpty()){
            $this->info("No pengguna found.");
        } else {
                foreach ($pengguna as $user){
                    $this->info("ID" . $user->id_pengguna);
                    $this->info("Nama" . $user->nama);
                    $this->info("Email" . $user->email);
                    $this->info("Nomor Telepon" . $user->nomor_telepon);
                    $this->info("Role" . $user->role);
                    $this->info("-----------------------");
                }
        }
    }

}
