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
                    <p class="text-2xl">{{$totalPendapatan->harga}}</p>
                </div>
            </div>
        @else
            <h2 class="text-2xl font-bold mb-4">Available Buses</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($buses as $bus)
                    <div class="flex flex-col bg-white rounded-3xl shadow-lg">
                        <div class="px-6 py-8 sm:p-10 sm:pb-6">
                            <div class="grid items-center justify-center w-full grid-cols-1 text-left">
                                <div>
                                    <h3 class="text-2xl font-semibold text-gray-700">{{ $bus->nama_bus }}</h3>
                                    <p class="mt-2 text-sm text-gray-500">Plate: {{ $bus->plat_nomor }}</p>
                                    <p class="mt-2 text-sm text-gray-500">Capacity: {{ $bus->kapasitas }} seats</p>
                                </div>
                                
                                @foreach($bus->busRute as $busRute)
                                    <p class="mt-2 text-sm text-gray-500"><strong>Route:</strong> {{ $busRute->rute->asal }} - {{ $busRute->rute->tujuan }}</p>
                                @endforeach
            
                                @php
                                    $kelas = $bus->busKelas->first();
                                @endphp
            
                                @if ($kelas && $kelas->kelas)
                                    <p class="mt-2 text-sm text-gray-500"><strong>Class:</strong> {{ $kelas->kelas->nama_kelas }}</p>
                                @endif
            
                                @php
                                    $harga = $bus->busRute->first()
                                        ? $bus->busRute->first()->rute->harga->firstWhere('id_kelas', $kelas?->id_kelas)
                                        : null;
                                @endphp
            
                                @if ($harga)
                                    <p class="mt-2 text-lg font-semibold text-black"><strong>Price:</strong> Rp {{ number_format($harga->harga, 0, ',', '.') }}</p>
                                @else
                                    <p class="mt-2 text-lg font-semibold text-gray-500"><strong>Price:</strong> Not available</p>
                                @endif
                            </div>
                        </div>
            
                        <div class="flex px-6 pb-8 sm:px-8">
                            <a href="{{ route('pemesanan.create', ['bus_id' => $bus->id_bus]) }}" class="w-full px-6 py-2.5 text-center text-white duration-200 bg-black border-2 border-black rounded-full hover:bg-transparent hover:border-black hover:text-black focus:outline-none text-sm">
                                Pesan Sekarang!
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            
        @endif
    </div>
@endsection
