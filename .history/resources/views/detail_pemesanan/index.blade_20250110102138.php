@extends('layouts.app')

@section('title', 'Detail Pemesanan')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Detail Pemesanan - {{ $pemesanan->id_pemesanan }}</h1>

    <table class="table-auto w-full border-collapse">
        <thead>
            <tr>
                <th class="px-4 py-2">No</th>
                <th class="px-4 py-2">Nama Penumpang</th>
                <th class="px-4 py-2">Nomor Identitas</th>
                <th class="px-4 py-2">Nomor Kursi</th> <!-- Added this column -->
                <th class="px-4 py-2">Harga Kursi</th>
                <th class="px-4 py-2">Total Harga</th>
            </
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
                    <td class="border px-4 py-2">
                        <form action="{{ route('detail_pemesanan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this detail?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                        </form>                        
                    </td>
                </tr>
            @endforeach
        </tbody>        
    </table>
@endsection
