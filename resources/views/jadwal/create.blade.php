@extends('layouts.app')
@if (auth()->user()->role === 'admin') 
@section('content')
<div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Create New Jadwal</h1>
    
    <form action="{{ route('jadwal.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="id_bus_rute" class="block text-sm font-medium text-gray-700">Bus Rute</label>
            <select name="id_bus_rute" id="id_bus_rute" class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                @foreach($busRutes as $busRute)
                    <option value="{{ $busRute->id_bus_rute }}">
                        {{ $busRute->bus->nama_bus }} - {{ $busRute->rute->name }}
                    </option>
                @endforeach
            </select>
            @error('id_bus_rute')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        
        <div>
            <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            @error('tanggal')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="waktu_berangkat" class="block text-sm font-medium text-gray-700">Waktu Berangkat</label>
            <input type="time" name="waktu_berangkat" id="waktu_berangkat" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            @error('waktu_berangkat')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="waktu_tiba" class="block text-sm font-medium text-gray-700">Waktu Tiba</label>
            <input type="time" name="waktu_tiba" id="waktu_tiba" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            @error('waktu_tiba')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow-md transition duration-200">Save</button>
    </form>
</div>
@endsection
@endif
