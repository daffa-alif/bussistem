@extends('layouts.app')

@section('content')

<form action="{{ route('detail_pemesanan.store', ['id_pemesanan' => $pemesanan->id_pemesanan, 'id_kursi_bus' => $id_kursi_bus]) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md space-y-6 w-1/2 mx-auto">
    @csrf

    <div>
        <label for="nama_penumpang" class="block text-sm font-medium text-gray-700">Nama Penumpang</label>
        <input type="text" name="nama_penumpang" id="nama_penumpang" required class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        @error('nama_penumpang')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="nomor_identitas" class="block text-sm font-medium text-gray-700">Nomor Identitas</label>
        <input type="text" name="nomor_identitas" id="nomor_identitas" required class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        @error('nomor_identitas')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="total_harga" class="block text-sm font-medium text-gray-700">Total Harga</label>
        <input type="number" step="0.01" name="total_harga" id="total_harga" required class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
        @error('total_harga')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">Simpan</button>
</form>

@endsection
