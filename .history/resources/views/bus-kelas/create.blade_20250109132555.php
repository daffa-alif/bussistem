@extends('layout.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold mb-4">Create Bus Kelas</h1>

        <!-- Create BusKelas Form -->
        <form action="{{ url('/bus-kelas') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="id_bus" class="block text-sm font-medium text-gray-700">Bus</label>
                <input type="number" id="id_bus" name="id_bus" required class="mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="Bus ID">
            </div>

            <div class="mb-4">
                <label for="id_kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                <input type="number" id="id_kelas" name="id_kelas" required class="mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="Class ID">
            </div>

            <div class="flex items-center space-x-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create</button>
                <a href="{{ url('/bus-kelas') }}" class="text-gray-500 hover:text-gray-700">Cancel</a>
            </div>
        </form>
    </div>
@endsection
