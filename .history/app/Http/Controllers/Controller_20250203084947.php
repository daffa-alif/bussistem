<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;

class Controller extends Controller
{
    public function index()
    {
        $buses = Bus::with(['busRute.rute', 'busKelas.kelas'])->get();
        return view('welcome', compact('buses'));
    }
}