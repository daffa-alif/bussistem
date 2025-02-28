@extends('layouts.app')
@if (auth()->user()->role === 'admin') 
@section('content')
<div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold mb-6">Edit Kursi Bus</h1>

        <form action="{{ route('kursibus.update', $kursiBus->id_kursi) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Bus Selection -->
            <div class="mb-6">
                <label for="id_bus" class="block text-sm font-medium text-gray-700">Bus</label>
                <select name="id_bus" id="id_bus" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Select Bus</option>
                    @foreach($buses as $bus)
                    <option value="{{ $bus->id_bus }}" {{ $bus->id_bus == $kursiBus->id_bus ? 'selected' : '' }}>
                            {{ $bus->nama_bus }} - {{ $bus->plat_nomor }}
                        </option>
                        @endforeach
                </select>
                @error('id_bus')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Kelas Selection -->
            <div class="mb-6">
                <label for="id_kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                <select name="id_kelas" id="id_kelas" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Select Kelas</option>
                    @foreach($kelas as $kls)
                        <option value="{{ $kls->id_kelas }}" {{ $kls->id_kelas == $kursiBus->id_kelas ? 'selected' : '' }}>
                            {{ $kls->nama_kelas }}
                        </option>
                    @endforeach
                </select>
                @error('id_kelas')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nomor Kursi -->
                <div class="mb-6">
                    <label for="nomor_kursi" class="block text-sm font-medium text-gray-700">Nomor Kursi</label>
                <input type="text" name="nomor_kursi" id="nomor_kursi" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $kursiBus->nomor_kursi }}" required>
                @error('nomor_kursi')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Status Kursi -->
            <div class="mb-6">
                <label for="status_kursi" class="block text-sm font-medium text-gray-700">Status Kursi</label>
                <select name="status_kursi" id="status_kursi" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="available" {{ $kursiBus->status_kursi == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="booked" {{ $kursiBus->status_kursi == 'booked' ? 'selected' : '' }}>Booked</option>
                </select>
                @error('status_kursi')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">Save</button>
        </form>
    </div>
@endsection

            @endif