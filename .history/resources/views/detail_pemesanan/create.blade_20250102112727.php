@extends('layouts.app')

@section('content')
<form action="{{ route('detail_pemesanan.store', $pemesanan->id_pemesanan) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md space-y-6 w-1/2 mx-auto">
    @csrf
    
    <div>
        <label for="id_kursi_bus" class="block text-sm font-medium text-gray-700">Kursi Bus</label>
        <select id="id_kursi_bus" name="id_kursi_bus" required class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">Select Kursi</option>
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
        <input type="text" name="nama_penumpang" required class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div>
        <label for="nomor_identitas" class="block text-sm font-medium text-gray-700">Nomor Identitas</label>
        <input type="text" name="nomor_identitas" required class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div>
        <label for="harga_kursi" class="block text-sm font-medium text-gray-700">Harga Kursi</label>
        <input type="number" id="harga_kursi" step="0.01" name="harga_kursi" required readonly class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div>
        <label for="total_harga" class="block text-sm font-medium text-gray-700">Total Harga</label>
        <input type="number" id="total_harga" step="0.01" name="total_harga" required readonly class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">Save</button>
</form>

@section('scripts')
<script>
    // When the kursi bus is selected
    document.getElementById('id_kursi_bus').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var harga = selectedOption.getAttribute('data-harga');

        // Set harga_kursi field with the selected harga
        document.getElementById('harga_kursi').value = harga;

        // Update total_harga field (assuming no additional logic is required for now)
        document.getElementById('total_harga').value = harga;
    });
</script>
@endsection
@endsection
