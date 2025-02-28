<?php

namespace App\Jobs;

use App\Models\Pemesanan;
use Carbon\Carbon;

class CancelPendingBookings extends Job
{
    public function __construct()
    {
        // Job constructor - no need for additional data
    }

    public function handle()
    {
        // Cancel pending bookings older than 3 minutes
        Pemesanan::where('status', 'pending')
            ->where('tanggal_pemesanan', '<', Carbon::now()->subMinutes(3))
            ->update(['status' => 'cancelled']);
    }
}
