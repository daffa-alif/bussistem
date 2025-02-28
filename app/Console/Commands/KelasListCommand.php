<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Kelas;

class KelasListCommand extends Command
{
    protected $signature = 'kelas:list';
    protected $description = 'List all classes';

    public function handle()
    {
        $classes = Kelas::all();

        if ($classes->isEmpty()) {
            $this->info("No classes found.");
        } else {
            $this->table(
                ['ID', 'Nama Kelas'],
                $classes->toArray()
            );
        }
    }
}
