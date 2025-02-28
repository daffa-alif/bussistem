<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Rute;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('search');

        // Search buses by name or plate number
        $buses = Bus::where('nama_bus', 'LIKE', "%{$query}%")
            ->orWhere('plat_nomor', 'LIKE', "%{$query}%")
            ->get();

        // Search routes by origin or destination
        $routes = Rute::where('asal', 'LIKE', "%{$query}%")
            ->orWhere('tujuan', 'LIKE', "%{$query}%")
            ->get();

        // Check if there are results
        $hasResults = $buses->isNotEmpty() || $routes->isNotEmpty();

        return view('search-results', compact('buses', 'routes', 'query', 'hasResults'));
    }
}
