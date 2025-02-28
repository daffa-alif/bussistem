@extends('layouts.app')
@if (auth()->user()->role === 'admin') 
@section('content')
<div class="container">
        <h1 class="text-xl font-bold mb-4">Kursi Bus</h1>
        <a href="{{ route('kursibus.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded-md mb-4 inline-block">Add New Kursi</a>
        
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 mb-4 rounded-md">
                {{ session('success') }}
            </div>
        @endif
        
        <table class="table-auto w-full border-collapse">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Bus</th>
                    <th class="border px-4 py-2">Kelas</th>
                    <th class="border px-4 py-2">Nomor Kursi</th>
                    <th class="border px-4 py-2">Status Kursi</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kursiBuses as $kursiBus)
                    <tr>
                        <td class="border px-4 py-2">{{ $kursiBus->bus->nama_bus }}</td>
                        <td class="border px-4 py-2">{{ $kursiBus->kelas->nama_kelas }}</td>
                        <td class="border px-4 py-2">{{ $kursiBus->nomor_kursi }}</td>
                        <td class="border px-4 py-2">{{ $kursiBus->status_kursi }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('kursibus.edit', $kursiBus->id_kursi) }}" class="text-blue-600">Edit</a> |
                            <form action="{{ route('kursibus.destroy', $kursiBus->id_kursi) }}" method="POST" class="inline-block">
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

    @endif