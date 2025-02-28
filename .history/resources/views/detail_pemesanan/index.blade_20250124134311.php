@extends('layouts.app')

@section('title', 'Detail Pemesanan')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Detail Pemesanan - {{ $pemesanan->id_pemesanan }}</h1>

    @if (auth()->user()->role === 'admin')
        <!-- Admin View: Display table -->
        <table class="table-auto w-full border-collapse">
            <thead>
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Nama Penumpang</th>
                    <th class="px-4 py-2">Nomor Identitas</th>
                    <th class="px-4 py-2">Nomor Kursi</th>
                    <th class="px-4 py-2">Harga Kursi</th>
                    <th class="px-4 py-2">Total Harga</th>
                    <th class="px-4 py-2">Aksi</th> <!-- Added column for actions -->
                </tr>
            </thead>
            <tbody>
                @foreach ($detailPemesanan as $key => $item)
                    <tr>
                        <td class="border px-4 py-2">{{ $key + 1 }}</td>
                        <td class="border px-4 py-2">{{ $item->nama_penumpang }}</td>
                        <td class="border px-4 py-2">{{ $item->nomor_identitas }}</td>
                        <td class="border px-4 py-2">{{ $item->kursiBus->nomor_kursi ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">{{ number_format($item->harga_kursi, 2) }}</td>
                        <td class="border px-4 py-2">{{ number_format($item->total_harga, 2) }}</td>
                        <td class="border px-4 py-2 text-center">
                            <!-- Add Edit Button -->
                            <a href="{{ route('detail_pemesanan.edit', $item->id_detail_pemesanan) }}" class="text-blue-600 hover:underline">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <!-- Non-Admin View: Display as a ticket card -->
        <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-lg mt-4">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-semibold">Ticket Details</h2>
                <p class="text-gray-600">Booking ID: {{ $pemesanan->id_pemesanan }}</p>
            </div>

            @foreach ($detailPemesanan as $item)
                <div class="border-b pb-4 mb-4">
                    <div class="flex justify-between">
                        <span class="font-semibold">Nama Penumpang:</span>
                        <span>{{ $item->nama_penumpang }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Nomor Identitas:</span>
                        <span>{{ $item->nomor_identitas }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Nomor Kursi:</span>
                        <span>{{ $item->kursiBus->nomor_kursi ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Harga Kursi:</span>
                        <span>{{ number_format($item->harga_kursi, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Total Harga:</span>
                        <span>{{ number_format($item->total_harga, 2) }}</span>
                    </div>
                </div>
            @endforeach

            <div class="text-center mt-6">
                <a href="{{ route('pemesanan.index') }}" class="bg-blue-500 text-white py-2 px-4 rounded-full hover:bg-blue-600">Back to Bookings</a>
            </div>
        </div>
    @endif
@endsection
