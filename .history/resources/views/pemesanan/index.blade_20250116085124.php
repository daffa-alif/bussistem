@extends('layouts.app')
@if (auth()->user()->role === 'admin') 
@section('title', 'Pemesanan List')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Pemesanan List</h1>

    <table class="table-auto w-full border-collapse">
        <thead>
            <tr>
                <th class="px-4 py-2">No</th>
                <th class="px-4 py-2">User</th>
                <th class="px-4 py-2">Jadwal</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Tanggal Pemesanan</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pemesanan as $key => $item)
                <tr>
                    <td class="border px-4 py-2">{{ $key + 1 }}</td>
                    <td class="border px-4 py-2">{{ $item->user->nama ?? 'N/A' }}</td>
                    <td class="border px-4 py-2">{{ $item->jadwal->detail ?? 'N/A' }}</td>
                    <td class="border px-4 py-2">{{ $item->status }}</td>
                    <td class="border px-4 py-2">{{ $item->tanggal_pemesanan }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('detail_pemesanan.create', $item->id_pemesanan) }}" class="btn btn-primary">Lanjut</a>
                        <a href="{{ route('detail_pemesanan.index', $item->id_pemesanan) }}" class="text-blue-500">Detail Pemesanan</a> |
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('pemesanan.edit', $item->id_pemesanan) }}" class="text-blue-500">Edit</a> |
                            <form action="{{ route('pemesanan.destroy', $item->id_pemesanan) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
@endsection
