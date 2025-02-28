@extends('layouts.app')

@section('title', 'Create Pemesanan')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Create Pemesanan</h1>

    <form action="{{ route('pemesanan.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf

        <div class="mb-4">
            <label for="id_jadwal" class="block text-sm font-medium text-gray-700">Jadwal</label>
            <select name="id_jadwal" id="id_jadwal" class="w-full border rounded px-3 py-2" required>
                <option value="">Select Jadwal</option>
                @foreach($jadwal as $jad)
                    <option value="{{ $jad->id_jadwal }}">
                        {{ $jad->waktu_berangkat }} - {{ $jad->waktu_tiba }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" id="status" class="w-full border rounded px-3 py-2" required>
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="cancelled">Cancelled</option>
                <option value="booking">Booking</option>
            </select>
        </div>

        <div class="mb-4">
            @php
                $existingPemesanan = App\Models\DetailPemesanan::where('id_pemesanan', $pemesanan->id_pemesanan)->first();
            @endphp

            @if ($existingPemesanan)
                <button type="button" class="w-full bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600" data-modal-toggle="detailPemesananModal">
                    View Detail Pemesanan
                </button>
            @else
                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Create</button>
            @endif
        </div>
    </form>

    <!-- Modal -->
    <div id="detailPemesananModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-xl font-semibold mb-4">Detail Pemesanan</h2>

            <div id="detailPemesananData">
                <!-- Existing Detail Pemesanan data will be shown here -->
            </div>

            <button type="button" class="mt-4 w-full bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600" data-modal-toggle="detailPemesananModal">
                Close
            </button>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Toggle modal visibility
        const modalToggleButtons = document.querySelectorAll('[data-modal-toggle]');
        const modal = document.getElementById('detailPemesananModal');

        modalToggleButtons.forEach(button => {
            button.addEventListener('click', () => {
                modal.classList.toggle('hidden');
                if (modal.classList.contains('hidden')) {
                    fetchDetailPemesanan();
                }
            });
        });

        // Fetch the detail pemesanan data
        function fetchDetailPemesanan() {
            // Example: AJAX fetch call to get data
            fetch('{{ route('detail_pemesanan.fetch', $pemesanan->id_pemesanan) }}')
                .then(response => response.json())
                .then(data => {
                    let htmlContent = '<ul>';
                    data.forEach(detail => {
                        htmlContent += `
                            <li>
                                <strong>Nama Penumpang:</strong> ${detail.nama_penumpang} <br>
                                <strong>Nomor Identitas:</strong> ${detail.nomor_identitas} <br>
                                <strong>Harga Kursi:</strong> ${detail.harga_kursi} <br>
                                <strong>Total Harga:</strong> ${detail.total_harga}
                            </li>
                        `;
                    });
                    htmlContent += '</ul>';
                    document.getElementById('detailPemesananData').innerHTML = htmlContent;
                })
                .catch(error => console.error('Error fetching data:', error));
        }
    </script>
@endsection
