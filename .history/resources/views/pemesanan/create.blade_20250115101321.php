@extends('layouts.app')

@section('title', 'Create Pemesanan')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Create Pemesanan</h1>

    <form action="{{ route('pemesanan.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md" id="pemesanan-form">
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
                    <option value="{{ $jad->id_jadwal }}" data-bus="{{ $jad->busRute->bus->id_bus }}">
                        {{ $jad->waktu_berangkat }} - {{ $jad->waktu_tiba }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4 hidden" id="select-seat-div">
            <button type="button" id="select-seat-btn" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                Select Seat
            </button>
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

    <div id="seat-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
            <h3 class="text-lg font-semibold mb-4">Select a Seat</h3>
            <div id="seat-container" class="grid grid-cols-4 gap-4">
                <!-- Seats will be dynamically loaded here -->
            </div>
            <button type="button" id="close-seat-modal" class="mt-4 bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
                Close
            </button>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const jadwalSelect = document.getElementById('id_jadwal');
    const seatModal = document.getElementById('seat-modal');
    const seatContainer = document.getElementById('seat-container');
    const closeSeatModal = document.getElementById('close-seat-modal');
    const form = document.getElementById('pemesanan-form');

    jadwalSelect.addEventListener('change', function () {
        const busId = this.options[this.selectedIndex].getAttribute('data-bus');
        if (busId) {
            document.getElementById('select-seat-div').classList.remove('hidden');
            document.getElementById('select-seat-btn').addEventListener('click', function () {
                fetch(`/get-available-seats/${busId}`)
                    .then(response => response.json())
                    .then(data => {
                        seatContainer.innerHTML = '';
                        data.seats.forEach(seat => {
                            const seatButton = document.createElement('button');
                            seatButton.textContent = seat.nomor_kursi;
                            seatButton.classList.add('bg-gray-200', 'py-2', 'px-4', 'rounded', 'hover:bg-blue-500', 'hover:text-white');
                            seatButton.dataset.kursiId = seat.id_kursi;

                            seatButton.addEventListener('click', function () {
                                document.getElementById('select-seat-btn').textContent = `Selected Seat: ${seat.nomor_kursi}`;
                                form.action += `?id_kursi_bus=${seat.id_kursi}`;
                                seatModal.classList.add('hidden');
                            });

                            seatContainer.appendChild(seatButton);
                        });

                        seatModal.classList.remove('hidden');
                    })
                    .catch(error => console.error('Error fetching seats:', error));
            });
        } else {
            document.getElementById('select-seat-div').classList.add('hidden');
        }
    });

    closeSeatModal.addEventListener('click', () => {
        seatModal.classList.add('hidden');
    });
</script>
@endpush
