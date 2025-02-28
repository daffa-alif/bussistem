@extends('layouts.app')

@section('title', auth()->user()->role === 'admin' ? 'Pemesanan List' : 'Your Bookings')

@section('content')
    @if (auth()->user()->role === 'admin')
        <h1 class="text-2xl font-semibold mb-4">Pemesanan List</h1>

        {{-- Delete All Cancelled Button --}}
        <div class="mb-4">
            <form action="{{ route('pemesanan.deleteCancelled') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger px-4 py-2">Delete All Cancelled</button>
            </form>
        </div>

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
                            <a href="{{ route('pemesanan.edit', $item->id_pemesanan) }}" class="text-blue-500">Edit</a> |
                            <form action="{{ route('pemesanan.destroy', $item->id_pemesanan) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
    <h1 class="text-2xl font-semibold mb-4">Your Bookings</h1>

    <div class="grid grid-cols-1 gap-4">
        @forelse ($pemesanan as $item)
            <div class="border rounded-lg shadow p-4">
                <h2 class="text-xl font-bold mb-2">User: {{ $item->user->nama ?? 'N/A' }}</h2>
                <p><strong>Jadwal:</strong> {{ $item->jadwal->detail ?? 'N/A' }}</p>
                <p><strong>Status:</strong> {{ $item->status }}</p>
                <p><strong>Tanggal Pemesanan:</strong> {{ $item->tanggal_pemesanan }}</p>
                <div class="mt-4">
                    @if ($item->status !== 'cancelled')
                        <form action="{{ route('pemesanan.cancel', $item->id_pemesanan) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="text-red-500">Cancel</button>
                        </form>
                    @else
                        <span class="text-gray-500">Cancelled</span>
                    @endif
                    <a href="{{ route('detail_pemesanan.index', $item->id_pemesanan) }}" class="text-blue-500 ml-4">Detail Pemesanan</a>
    
                    <!-- Bayar Button (redirects to bayar.index) -->
                    @if ($item->status === 'confirmed')
                        <a href="{{ route('bayar.index', $item->id_pemesanan) }}" class="text-green-500 ml-4">Bayar</a>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-gray-500">No bookings found.</p>
        @endforelse
    </div>
    
    @endif
@endsection
