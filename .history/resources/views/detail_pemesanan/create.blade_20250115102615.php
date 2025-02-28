@extends('layouts.app')

@section('content')

<form action="{{ route('detail_pemesanan.store', $pemesanan->id_pemesanan) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md space-y-6 w-1/2 mx-auto">
    @csrf

    <div>
        <label for="id_kursi_bus" class="block text-sm font-medium text-gray-700">Kursi Bus</label>
        <select name="id_kursi_bus" id="id_kursi_bus" required class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">Pilih Kursi</option>
            @foreach($kursiBus as $kursi)
                <option value="{{ $kursi->id_kursi }}" data-harga="{{ $kursi->harga }}">{{ $kursi->nomor_kursi }}</option>
            @endforeach
        </select>
        @error('id_kursi_bus')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

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

@push('scripts')
<script>
    document.getElementById('id_kursi_bus').addEventListener('change', function() {
        const kursiBusId = this.value;
        const selectedOption = this.options[this.selectedIndex];
        const harga = selectedOption.getAttribute('data-harga');

        if (kursiBusId) {
            // Set the total harga based on the selected kursi_bus
            document.getElementById('total_harga').value = harga;
        } else {
            document.getElementById('total_harga').value = '';
        }
    });
</script>
@endpush
