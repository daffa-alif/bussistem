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

        <div class="mb-4">
            <label for="id_kursi_bus" class="block text-sm font-medium text-gray-700">Kursi Bus</label>
            <select name="id_kursi_bus" id="id_kursi_bus" class="w-full border rounded px-3 py-2" required>
                <option value="">Select Kursi</option>
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

    <div id="bus-info" class="mt-6 bg-gray-100 p-4 rounded shadow hidden">
        <h3 class="text-lg font-semibold">Selected Bus Information</h3>
        <p id="bus-name"><strong>Bus:</strong> </p>
    </div>

    <script>
        const jadwalSelect = document.getElementById('id_jadwal');
        const kursiBusSelect = document.getElementById('id_kursi_bus');
        const busInfoDiv = document.getElementById('bus-info');
        const busName = document.getElementById('bus-name');

        jadwalSelect.addEventListener('change', function () {
            const selectedOption = jadwalSelect.options[jadwalSelect.selectedIndex];
            const busNameValue = selectedOption.getAttribute('data-bus');

            if (busNameValue) {
                busName.innerHTML = `<strong>Bus:</strong> ${busNameValue}`;
                busInfoDiv.classList.remove('hidden');
                
                // Fetch available seats for the selected bus
                const idJadwal = selectedOption.value;
                fetch(`/kursi-bus/${idJadwal}`)
                    .then(response => response.json())
                    .then(data => {
                        kursiBusSelect.innerHTML = `<option value="">Select Kursi</option>`;
                        data.kursi.forEach(kursi => {
                            kursiBusSelect.innerHTML += `<option value="${kursi.id_kursi}" data-kelas-id="${kursi.id_kelas}">${kursi.nomor_kursi}</option>`;
                        });
                    });
            } else {
                busInfoDiv.classList.add('hidden');
                kursiBusSelect.innerHTML = `<option value="">Select Kursi</option>`;
            }
        });
    </script>
@endsection
