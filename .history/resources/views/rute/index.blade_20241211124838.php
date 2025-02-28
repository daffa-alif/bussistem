@extends('layouts.app')

@section('title', 'Rute List')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Rute</h2>
        <a href="{{ route('rute.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Add Rute</a>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 mt-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white shadow-md rounded mt-4">
            <thead>
                <tr class="border-b">
                    <th class="px-4 py-2 text-left">#</th>
                    <th class="px-4 py-2 text-left">Asal</th>
                    <th class="px-4 py-2 text-left">Tujuan</th>
                    <th class="px-4 py-2 text-left">Jarak (km)</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rute as $item)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $item->asal }}</td>
                        <td class="px-4 py-2">{{ $item->tujuan }}</td>
                        <td class="px-4 py-2">{{ $item->jarak_km }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('rute.edit', $item->id_rute) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                            <form action="{{ route('rute.destroy', $item->id_rute) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
