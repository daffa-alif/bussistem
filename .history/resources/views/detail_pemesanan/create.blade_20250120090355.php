@extends('layouts.app')

@section('content')
<form action="{{ route('detail_pemesanan.store', $pemesanan->id_pemesanan) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md space-y-6 w-1/2 mx-auto">
    @csrf
    
    <div>
        <label for="id_kursi_bus" class="block text-sm font-medium text-gray-700">Kursi Bus</label>
        <select name="id_kursi_bus" id="id_kursi_bus" required class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">Pilih Kursi</option>
            @foreach($kursiBus as $kursi)
                @if($kursi->status_kursi === 'available')
                    <option value="{{ $kursi->id_kursi }}" data-kelas-id="{{ $kursi->id_kelas }}">{{ $kursi->nomor_kursi }}</option>
                @endif
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
        <!-- Read-only price display -->
        <p id="total_harga" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm bg-gray-100 text-gray-600"></p>
        @error('total_harga')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="flex justify-between">
        <button type="submit" name="action" value="add_another" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">Add Another</button>
        <button type="submit" name="action" value="finish" class="bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200">Finish</button>
    </div>
</form>
@endsection

@push('scripts')
<script>
 document.getElementById('id_kursi_bus').addEventListener('change', function () {
    const kursiBusId = this.value;

    if (kursiBusId) {
        const idKelas = this.options[this.selectedIndex].getAttribute('data-kelas-id');

        fetch(`/get-harga/${idKelas}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to fetch harga.');
                }
                return response.json();
            })
            .then(data => {
                if (data.harga_kursi) {
                    // Format the price to Indonesian currency and display it
                    const formattedPrice = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }).format(data.harga_kursi);

                    document.getElementById('total_harga').textContent = formattedPrice;
                } else {
                    alert('Harga tidak ditemukan untuk kelas ini.');
                    document.getElementById('total_harga').textContent = '';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengambil harga.');
            });
    } else {
        document.getElementById('total_harga').textContent = '';
    }
});

</script>
@endpush
