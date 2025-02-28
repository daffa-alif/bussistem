@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Your Bookings</h1>

<div class="grid grid-cols-1 gap-4">
    @forelse ($pemesanans as $item)
        <div class="border rounded-lg shadow p-4">
            <h2 class="text-xl font-bold mb-2">User: {{ $item->user->nama ?? 'N/A' }}</h2>
            <p><strong>Jadwal:</strong> {{ $item->jadwal->detail ?? 'N/A' }}</p>
            <p><strong>Status:</strong> {{ $item->status }}</p>
            <p><strong>Tanggal Pemesanan:</strong> {{ $item->tanggal_pemesanan }}</p>
            <p><strong>Total Harga:</strong> Rp. {{ number_format($item->total_harga, 2, ',', '.') }}</p> <!-- Display total_harga -->
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
            </div>
        </div>
    @empty
        <p class="text-gray-500">No bookings found.</p>
    @endforelse
</div>

@endsection
