@extends('layouts.app')

@section('title', 'Edit Rute')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Edit Rute</h2>
        <form action="{{ route('rute.update', $rute->id_rute) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="asal" class="block text-gray-700 font-bold mb-2">Asal:</label>
                <input type="text" name="asal" id="asal" class="w-full border rounded p-2" value="{{ old('asal', $rute->asal) }}">
                @error('asal')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="tujuan" class="block text-gray-700 font-bold mb-2">Tujuan:</label>
                <input type="text" name="tujuan" id="tujuan" class="w-full border rounded p-2" value="{{ old('tujuan', $rute->tujuan) }}">
                @error('tujuan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="jarak_km" class="block text-gray-700 font-bold mb-2">Jarak (km):</label>
                <input type="number" step="0.01" name="jarak_km" id="jarak_km" class="w-full border rounded p-2" value="{{ old('jarak_km', $rute->jarak_km) }}">
                @error('jarak_km')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Update</button>
        </form>
    </div>
@endsection
