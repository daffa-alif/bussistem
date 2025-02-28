@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Search Results for "{{ $query }}"</h2>

        @if (!$hasResults)
            <p class="text-gray-500">No data available.</p>
        @else
            <div class="mb-6">
                <h3 class="text-xl font-semibold mb-2">Buses</h3>
                @if ($buses->isEmpty())
                    <p class="text-gray-500">No buses found.</p>
                @else
                    <ul class="list-disc pl-6">
                        @foreach ($buses as $bus)
                            <li>
                                <strong>{{ $bus->nama_bus }}</strong> 
                                ({{ $bus->plat_nomor }}) - Capacity: {{ $bus->kapasitas }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div>
                <h3 class="text-xl font-semibold mb-2">Routes</h3>
                @if ($routes->isEmpty())
                    <p class="text-gray-500">No routes found.</p>
                @else
                    <ul class="list-disc pl-6">
                        @foreach ($routes as $route)
                            <li>
                                <strong>{{ $route->asal }} → {{ $route->tujuan }}</strong> 
                                ({{ $route->jarak_km }} km)
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endif

        <a href="{{ route('dashboard') }}" class="text-blue-500 mt-4 inline-block">Back to Dashboard</a>
    </div>
@endsection
