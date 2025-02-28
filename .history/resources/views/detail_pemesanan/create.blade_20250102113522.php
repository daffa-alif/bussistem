@extends('layouts.app')

@section('content')

<form action="{{ route('detail_pemesanan.store', $pemesanan->id_pemesanan) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md space-y-6 w-1/2 mx-auto">
    @csrf
    
    <div>
        <label for="id_kursi_bus" class="block text-sm font-medium text-gray-700">Kursi Bus</label>
        <select name="id_kursi_bus" id="id_kursi_bus" required class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">Select Kursi</option>
            @foreach($kursiBus as $kursi)
                <option value="{{ $kursi->id_kursi }}" data-kelas-id="{{ $kursi->id_kelas }}">{{ $kursi->nomor_kursi }}</option>
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

    <!-- Removed harga_kursi input field since it will be fetched automatically -->
    
    <div>
        <label for="total_harga" class="block text-sm font-medium text-gray-700">Total Harga</label>
        <input type="number" step="0.01" name="total_harga" id="total_harga" required class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
    </div>

    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">Save</button>
</form>

@endsection

@push('scripts')
<script>
    document.getElementById('id_kursi_bus').addEventListener('change', function() {
        var kursiBusId = this.value;
        
        if (kursiBusId) {
            // Find the id_kelas from the data attribute
            var idKelas = this.options[this.selectedIndex].getAttribute('data-kelas-id');
            
            // Fetch the harga based on the id_kelas
            fetch(`/get-harga/${idKelas}`)
                .then(response => response.json())
                .then(data => {
                    if (data.harga_kursi) {
                        // Automatically update the harga_kursi value
                        var harga = data.harga_kursi;
                        
                        // Set the total_harga to harga (adjust this if you need more logic)
                        document.getElementById('total_harga').value = harga;
                    }
                })
                .catch(error => console.error('Error fetching harga:', error));
        }
    });
</script>
@endpush
