@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-xl font-bold mb-4">Jadwal</h1>
        <a href="{{ route('jadwal.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded-md mb-4 inline-block">Add New Jadwal</a>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 mb-4 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <table class="table-auto w-full border-collapse">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Nama Bus</th>
                    <th class="border px-4 py-2">Tujuan</th>
                    <th class="border px-4 py-2">Tanggal</th>
                    <th class="border px-4 py-2">Waktu Berangkat</th>
                    <th class="border px-4 py-2">Waktu Tiba</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jadwals as $jadwal)
                    <tr>
                        <td class="border px-4 py-2">{{ $jadwal->busRute->bus->nama_bus ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">{{ $jadwal->busRute->rute->tujuan ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">{{ $jadwal->tanggal }}</td>
                        <td class="border px-4 py-2">{{ $jadwal->waktu_berangkat }}</td>
                        <td class="border px-4 py-2">{{ $jadwal->waktu_tiba }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('jadwal.edit', $jadwal->id_jadwal) }}" class="text-blue-600">Edit</a> |
                            <form action="{{ route('jadwal.destroy', $jadwal->id_jadwal) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
