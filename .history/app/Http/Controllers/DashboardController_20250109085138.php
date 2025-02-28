<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Rute;
use App\Models\Kelas;
use App\Models\Harga;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the count of users where role is not 'admin'
        $totalUsers = User::where('role', '!=', 'admin')->count();

        // Fetch all buses with related data
        $buses = Bus::with(['busRute.rute', 'busKelas.kelas'])->get();

        // Return the dashboard view with the total user count and buses
        return view('dashboard', compact('totalUsers', 'buses'));
    }
}
