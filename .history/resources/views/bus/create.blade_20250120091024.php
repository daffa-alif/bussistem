@extends('layouts.app')
@if (auth()->user()->role === 'admin') 

@section('title', 'Add New Bus')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Add New Bus</h2>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('bus.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nama_bus" class="block text-gray-700">Bus Name:</label>
                <input type="text" id="nama_bus" name="nama_bus" class="w-full border-gray-300 rounded mt-1" value="{{ old('nama_bus') }}" required>
            </div>
            <div class="mb-4">
                <label for="plat_nomor" class="block text-gray-700">License Plate:</label>
                <input type="text" id="plat_nomor" name="plat_nomor" class="w-full border-gray-300 rounded mt-1" value="{{ old('plat_nomor') }}" required>
            </div>
            <div class="mb-4">
                <label for="kapasitas" class="block text-gray-700">Capacity:</label>
                <input type="number" id="kapasitas" name="kapasitas" class="w-full border-gray-300 rounded mt-1" value="{{ old('kapasitas') }}" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save</button>
        </form>
    </div>
    @endsection
@endif
