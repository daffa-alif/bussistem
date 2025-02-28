@extends('layouts.app')

@section('title', 'Detail Pemesanan')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Detail Pemesanan</h1>

    <!-- Display existing details of the pemesanan -->
    <table class="table-auto w-full border-collapse">
        <thead>
            <tr>
                <th class="px-4 py-2 border">Nomor Kursi</th>
                <th class="px-4 py-2 border">Nama Penumpang</th>
                <th class="px-4 py-2 border">Nomor Identitas</th>
                <th class="px-4 py-2 border">Harga Kursi</th>
                <th class="px-4 py-2 border">Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detailPemesanan as $detail)
                <tr>
                    <td class="px-4 py-2 border">{{ $detail->kursiBus->nomor_kursi }}</td>
                    <td class="px-4 py-2 border">{{ $detail->nama_penumpang }}</td>
                    <td class="px-4 py-2 border">{{ $detail->nomor_identitas }}</td>
                    <td class="px-4 py-2 border">{{ number_format($detail->harga_kursi, 2) }}</td>
                    <td class="px-4 py-2 border">{{ number_format($detail->total_harga, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        <a href="{{ route('detail_pemesanan.create', ['id_pemesanan' => $pemesanan->id_pemesanan]) }}" class="text-blue-500 hover:text-blue-700">
            Add Detail Pemesanan
        </a>
    </div>
@endsection
