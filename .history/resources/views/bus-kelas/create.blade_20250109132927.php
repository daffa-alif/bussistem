@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold mb-4">Create Bus Kelas</h1>

        <!-- Create BusKelas Form -->
        <form action="{{ route('bus-kelas.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="id_bus" class="block text-sm font-medium text-gray-700">Bus</label>
                <select name="id_bus" id="id_bus" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                    <option value="">Select Bus</option>
                    @foreach($buses as $bus)
                        <option value="{{ $bus->id_bus }}">{{ $bus->nama_bus }}</option>
                    @endforeach
                </select>
                @error('id_bus')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="id_kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                <select name="id_kelas" id="id_kelas" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                    <option value="">Select Kelas</option>
                    @foreach($classes as $kelas)
                        <option value="{{ $kelas->id_kelas }}">{{ $kelas->nama_kelas }}</option>
                    @endforeach
                </select>
                @error('id_kelas')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex items-center space-x-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create</button>
                <a href="{{ route('bus-kelas.index') }}" class="text-gray-500 hover:text-gray-700">Cancel</a>
            </div>
        </form>
    </div>
@endsection
