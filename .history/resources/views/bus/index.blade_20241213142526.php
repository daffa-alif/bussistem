@extends('layouts.app')
@if (auth()->user()->role === 'admin') 
@section('title', 'Manage Buses')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Bus Management</h2>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
            @endif

        <a href="{{ route('bus.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add New Bus</a>

        <table class="min-w-full bg-white shadow-md rounded mt-4">
            <thead>
                <tr class="border-b">
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">License Plate</th>
                    <th class="px-4 py-2 text-left">Capacity</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($buses as $bus)
                <tr class="border-b">
                        <td class="px-4 py-2">{{ $bus->nama_bus }}</td>
                        <td class="px-4 py-2">{{ $bus->plat_nomor }}</td>
                        <td class="px-4 py-2">{{ $bus->kapasitas }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('bus.edit', $bus->id_bus) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                            <form action="{{ route('bus.destroy', $bus->id_bus) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this bus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@endif