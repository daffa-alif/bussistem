@extends('layouts.app')

@section('title', 'Create Pemesanan')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Create Pemesanan</h1>

    <form action="{{ route('pemesanan.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
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

        <input type="hidden" name="id_kursi_bus" id="id_kursi_bus">

        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Create</button>
    </form>

    <!-- Bus Info Modal -->
    <div id="bus-info" class="mt-6 bg-gray-100 p-4 rounded shadow hidden">
        <h3 class="text-lg font-semibold">Selected Bus Information</h3>
        <p id="bus-name"><strong>Bus:</strong> </p>
        <button id="showSeatsBtn" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded">Show Available Seats</button>
    </div>

    <!-- Available Seats Modal -->
    <div id="seats-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold mb-4">Available Seats</h3>
            <select id="kursi_bus" name="kursi_bus" class="w-full border rounded px-3 py-2">
                <option value="">Select Kursi</option>
                <!-- Kursi options will be populated here using JS -->
            </select>
            <button id="closeSeatsModal" class="mt-4 bg-red-500 text-white py-2 px-4 rounded">Close</button>
        </div>
    </div>

    <script>
        const jadwalSelect = document.getElementById('id_jadwal');
        const busInfoDiv = document.getElementById('bus-info');
        const busName = document.getElementById('bus-name');
        const showSeatsBtn = document.getElementById('showSeatsBtn');
        const seatsModal = document.getElementById('seats-modal');
        const kursiBusSelect = document.getElementById('kursi_bus');
        const closeSeatsModal = document.getElementById('closeSeatsModal');

        let selectedJadwal = null;

        jadwalSelect.addEventListener('change', function () {
            const selectedOption = jadwalSelect.options[jadwalSelect.selectedIndex];
            const busNameValue = selectedOption.getAttribute('data-bus');
            selectedJadwal = selectedOption.value;

            if (busNameValue) {
                busName.innerHTML = `<strong>Bus:</strong> ${busNameValue}`;
                busInfoDiv.classList.remove('hidden');
            } else {
                busInfoDiv.classList.add('hidden');
            }
        });

        showSeatsBtn.addEventListener('click', function () {
            if (selectedJadwal) {
                // Fetch available seats for the selected bus
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

                        seatsModal.classList.remove('hidden');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error fetching available seats');
                    });
            } else {
                alert('Please select a jadwal first.');
            }
        });

        kursiBusSelect.addEventListener('change', function () {
            const kursiBusId = this.value;
            if (kursiBusId) {
                // Set the selected kursi_bus to the hidden field
                document.getElementById('id_kursi_bus').value = kursiBusId;
            }
        });

        closeSeatsModal.addEventListener('click', function () {
            seatsModal.classList.add('hidden');
        });
    </script>
@endsection
