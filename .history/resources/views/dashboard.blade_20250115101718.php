@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Dashboard</h2>

        @if (auth()->user()->role === 'admin')
            <h2 class="text-2xl font-bold mb-4">Admin Overview</h2>
            <p class="mb-4">Welcome to the admin dashboard. Here you can manage the system.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="mt-6">
                    <h3 class="text-xl font-semibold mb-2">Total Users</h3>
                    <p class="text-2xl">{{ $totalUsers }}</p>
                </div>
                <div class="bg-white p-6 rounded shadow">
                    <h3 class="text-xl font-semibold mb-2">Active Sessions</h3>
                    <p class="text-2xl">567</p>
                </div>
                <div class="bg-white p-6 rounded shadow">
                    <h3 class="text-xl font-semibold mb-2">Revenue</h3>
                    <p class="text-2xl">$4,567</p>
                </div>
            </div>
        @else
            <h2 class="text-2xl font-bold mb-4">Available Buses</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($buses as $bus)
                    <div class="border p-4 rounded shadow">
                        <h3 class="text-xl font-semibold mb-2">{{ $bus->nama_bus }}</h3>
                        <p><strong>Plate:</strong> {{ $bus->plat_nomor }}</p>
                        <p><strong>Capacity:</strong> {{ $bus->kapasitas }} seats</p>

                        @foreach($bus->busRute as $busRute)
                            <p><strong>Route:</strong> {{ $busRute->rute->asal }} - {{ $busRute->rute->tujuan }}</p>
                        @endforeach

                        @php
                            $kelas = $bus->busKelas->first();
                        @endphp

                        @if ($kelas && $kelas->kelas)
                            <p><strong>Class:</strong> {{ $kelas->kelas->nama_kelas }}</p>
                        @endif

                        @php
                            $harga = $bus->busRute->first()
                                ? $bus->busRute->first()->rute->harga->firstWhere('id_kelas', $kelas?->id_kelas)
                                : null;
                        @endphp

                        @if ($harga)
                            <p><strong>Price:</strong> Rp {{ number_format($harga->harga, 0, ',', '.') }}</p>
                        @else
                            <p><strong>Price:</strong> Not available</p>
                        @endif

                        <a href="{{ route('pemesanan.create', ['bus_id' => $bus->id_bus]) }}" class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded">
    Pesan Sekarang!
</a>

                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
