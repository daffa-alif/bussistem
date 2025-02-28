<form action="{{ route('detail_pemesanan.store', $pemesanan->id_pemesanan) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md space-y-6 w-1/2 mx-auto">
    @csrf
    
    <div>
        <label for="id_kursi_bus" class="block text-sm font-medium text-gray-700">Kursi Bus</label>
        <select name="id_kursi_bus" required class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">Select Kursi</option>
            @foreach($kursiBus as $kursi)
                <option value="{{ $kursi->id_kursi }}">{{ $kursi->nomor_kursi }}</option> <!-- Display nomor_kursi but store id_kursi -->
            @endforeach
        </select>
        @error('id_kursi_bus')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Other fields for nama_penumpang, nomor_identitas, etc. -->

    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">Save</button>
</form>
