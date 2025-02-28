@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold mb-4">Bus Kelas List</h1>

        <!-- Table -->
        <table class="min-w-full table-auto border-collapse border border-gray-200">
            <thead>
                <tr>
                    <th class="border-b px-4 py-2 text-left">Bus</th>
                    <th class="border-b px-4 py-2 text-left">Kelas</th>
                    <th class="border-b px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($busKelas as $busKelasItem)
                    <tr>
                        <!-- Display the 'nama_bus' from the Bus model -->
                        <td class="border-b px-4 py-2">{{ $busKelasItem->bus->nama_bus }}</td>

                        <!-- Display the 'nama_kelas' from the Kelas model -->
                        <td class="border-b px-4 py-2">{{ $busKelasItem->kelas->nama_kelas }}</td>

                        <td class="border-b px-4 py-2">
                            <form action="{{ url('bus-kelas/'.$busKelasItem->id_bus.'/'.$busKelasItem->id_kelas) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
