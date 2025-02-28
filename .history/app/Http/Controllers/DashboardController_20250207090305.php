<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Rute;
use App\Models\Kelas;
use App\Models\Harga;
use App\Models\User;
use App\Models\DetailPemesanan;


class DashboardController extends Controller
{
    public function index()
{
    $totalUsers = User::where('role', '!=', 'admin')->count();
    $buses = Bus::with(['busRute.rute', 'busKelas.kelas'])->get();

    // Get active sessions count
    $sessionKeys = Redis::keys(config('session.prefix', 'laravel') . ':*'); // Get all session keys
    $activeSessions = count($sessionKeys); // Count active sessions

    return view('dashboard', compact('totalUsers', 'buses', 'activeSessions'));
}
}
