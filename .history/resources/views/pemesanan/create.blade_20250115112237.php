@extends('layouts.app')

@section('title', 'Create Pemesanan')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Create Pemesanan</h1>

    <form action="{{ route('detail_pemesanan.store', $id_pemesanan) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        
        <!-- Add a hidden input for id_pemesanan -->
        <input type="hidden" name="id_pemesanan" value="{{ $id_pemesanan }}">

        @if (auth()->user()->role === 'admin') 
        <div class="mb-4">
            <label for="id_pengguna" class="block text-sm font-medium text-gray-700">User</label>
            <select name="id_pengguna" id="id_pengguna" class="w-full border rounded px-3 py-2">
                <option value="">Select User (Leave blank for authenticated user)</option>
                @foreach($users as $user)
                    <option value="{{ $user->id_pengguna }}">{{ $user->nama }}</option>
                @endforeach
            </select>
        </div>
        @endif

        <div class="mb-4">
            <label for="id_jadwal" class="block text-sm font-medium text-gray-700">Jadwal</label>
            <select name="id_jadwal" id="id_jadwal" class="w-full border rounded px-3 py-2" required>
                <option value="">Select Jadwal</option>
                @foreach($jadwal as $jad)
                    <option value="{{ $jad->id_jadwal }}" data-bus="{{ $jad->busRute->bus->nama_bus }}">
                        {{ $jad->waktu_berangkat }} - {{ $jad->waktu_tiba }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Dropdown for kursi_bus -->
        <div class="mb-4 hidden" id="kursi_bus_container">
            <label for="id_kursi_bus" class="block text-sm font-medium text-gray-700">Kursi Bus</label>
            <select name="id_kursi_bus" id="id_kursi_bus" class="w-full border rounded px-3 py-2">
                <option value="">Select Kursi</option>
                <!-- Kursi options will be populated here using JS -->
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

        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Create</button>
    </form>

    <script>
        const jadwalSelect = document.getElementById('id_jadwal');
        const kursiBusContainer = document.getElementById('kursi_bus_container');
        const kursiBusSelect = document.getElementById('id_kursi_bus');

        let selectedJadwal = null;

        jadwalSelect.addEventListener('change', function () {
            const selectedOption = jadwalSelect.options[jadwalSelect.selectedIndex];
            const busNameValue = selectedOption.getAttribute('data-bus');
            selectedJadwal = selectedOption.value;

            if (selectedJadwal) {
                // Show the kursi bus dropdown
                kursiBusContainer.classList.remove('hidden');
                
                // Fetch available seats for the selected jadwal
                fetch(`/get-available-seats/${selectedJadwal}`)
                    .then(response => response.json())
                    .then(data => {
                        kursiBusSelect.innerHTML = '<option value="">Select Kursi</option>'; // Reset select options

                        data.seats.forEach(seat => {
                            const option = document.createElement('option');
                            option.value = seat.id_kursi;
                            option.textContent = seat.nomor_kursi;
                            kursiBusSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error fetching available seats');
                    });
            } else {
                // Hide the kursi bus dropdown if no jadwal is selected
                kursiBusContainer.classList.add('hidden');
            }
        });

        // When a kursi is selected, add it as a hidden input to the form
        kursiBusSelect.addEventListener('change', function() {
            const selectedKursi = kursiBusSelect.value;
            if (selectedKursi) {
                let hiddenInput = document.querySelector('input[name="id_kursi"]');
                
                // If the hidden input exists, update it, otherwise create a new one
                if (!hiddenInput) {
                    hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'id_kursi';
                    document.querySelector('form').appendChild(hiddenInput);
                }
                hiddenInput.value = selectedKursi;
            }
        });
    </script>
@endsection
