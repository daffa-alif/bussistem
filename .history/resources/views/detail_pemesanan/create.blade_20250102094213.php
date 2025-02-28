

<form action="{{ route('detail_pemesanan.store', $pemesanan->id_pemesanan) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md space-y-4 w-1/2 mx-auto">
    @csrf
    <div>
        <label for="id_kursi_bus" class="block text-gray-700 font-semibold mb-2">Kursi Bus</label>
        <select name="id_kursi_bus" required class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <!-- Populate with available kursi_bus -->
        </select>
    </div>
    <div>
        <label for="nama_penumpang" class="block text-gray-700 font-semibold mb-2">Nama Penumpang</label>
        <input type="text" name="nama_penumpang" required class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>
    <div>
        <label for="nomor_identitas" class="block text-gray-700 font-semibold mb-2">Nomor Identitas</label>
        <input type="text" name="nomor_identitas" required class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>
    <div>
        <label for="harga_kursi" class="block text-gray-700 font-semibold mb-2">Harga Kursi</label>
        <input type="number" step="0.01" name="harga_kursi" required class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>
    <div>
        <label for="total_harga" class="block text-gray-700 font-semibold mb-2">Total Harga</label>
        <input type="number" step="0.01" name="total_harga" required class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>
    <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Save</button>
</form>
