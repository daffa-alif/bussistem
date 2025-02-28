@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-xl font-bold mb-4">Edit Jadwal</h1>
        
        <form action="{{ route('jadwal.update', $jadwal->id_jadwal) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="id_bus_rute" class="block text-sm font-medium text-gray-700">Bus Rute</label>
                <select name="id_bus_rute" id="id_bus_rute" class="form-select mt-1 block w-full" required>
                    <option value="">-- Select Bus Rute --</option>
                    @foreach($busRutes as $busRute)
                        <option value="{{ $busRute->id_bus_rute }}" {{ $busRute->id_bus_rute == $jadwal->id_bus_rute ? 'selected' : '' }}>
                            {{ $busRute->bus->name }} - {{ $busRute->rute->name }}
                        </option>
                    @endforeach
                </select>
                @error('id_bus_rute')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-input mt-1 block w-full" value="{{ $jadwal->tanggal }}" required>
                @error('tanggal')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="waktu_berangkat" class="block text-sm font-medium text-gray-700">Waktu Berangkat</label>
                <input type="time" name="waktu_berangkat" id="waktu_berangkat" class="form-input mt-1 block w-full" value="{{ $jadwal->waktu_berangkat }}" required>
                @error('waktu_berangkat')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="waktu_tiba" class="block text-sm font-medium text-gray-700">Waktu Tiba</label>
                <input type="time" name="waktu_tiba" id="waktu_tiba" class="form-input mt-1 block w-full" value="{{ $jadwal->waktu_tiba }}" required>
                @error('waktu_tiba')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">Update</button>
        </form>
    </div>
@endsection
